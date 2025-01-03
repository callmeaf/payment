<?php

namespace Callmeaf\Payment\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Media\Enums\MediaCollection;
use Callmeaf\Media\Enums\MediaDisk;
use Callmeaf\Payment\Events\PaymentDestroyed;
use Callmeaf\Payment\Events\PaymentDocumentsUpdated;
use Callmeaf\Payment\Events\PaymentForceDestroyed;
use Callmeaf\Payment\Events\PaymentIndexed;
use Callmeaf\Payment\Events\PaymentRestored;
use Callmeaf\Payment\Events\PaymentShowed;
use Callmeaf\Payment\Events\PaymentStatusUpdated;
use Callmeaf\Payment\Events\PaymentStored;
use Callmeaf\Payment\Events\PaymentTrashed;
use Callmeaf\Payment\Events\PaymentUpdated;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentDestroyRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentDocumentsUpdateRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentForceDestroyRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentIndexRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentRestoreRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentShowRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentStatusUpdateRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentStoreRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentTrashedIndexRequest;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentUpdateRequest;
use Callmeaf\Payment\Models\Payment;
use Callmeaf\Payment\Services\V1\PaymentService;
use Callmeaf\Payment\Utilities\V1\Api\Payment\PaymentResources;

class PaymentController extends ApiController
{
    protected PaymentService $paymentService;
    protected PaymentResources $paymentResources;
    public function __construct()
    {
        $this->paymentService = app(config('callmeaf-payment.service'));
        $this->paymentResources = app(config('callmeaf-payment.resources.payment'));
    }

    public static function middleware(): array
    {
        return app(config('callmeaf-payment.middlewares.payment'))();
    }

    public function index(PaymentIndexRequest $request)
    {
        try {
            $resources = $this->paymentResources->index();
            $payments = $this->paymentService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes(),events: [
                PaymentIndexed::class,
            ]);
            return apiResponse([
                'payments' => $payments,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(PaymentStoreRequest $request)
    {
        try {
            $resources = $this->paymentResources->store();
            $payment = $this->paymentService->create(data: $request->validated(),events: [
                PaymentStored::class
            ])->createByVariationsIds(variationsIds: $request->get('variations_ids'))
                ->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $payment->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(PaymentShowRequest $request,Payment $payment)
    {
        try {
            $resources = $this->paymentResources->show();
            $payment = $this->paymentService->setModel($payment)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    PaymentShowed::class,
                ],
            );
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(PaymentUpdateRequest $request,Payment $payment)
    {
        try {
            $resources = $this->paymentResources->update();
            $payment = $this->paymentService->setModel($payment)->update(data: $request->validated(),events: [
                PaymentUpdated::class,
            ])->syncCats(catIds: $request->get('cat_ids'))->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $payment->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(PaymentStatusUpdateRequest $request,Payment $payment)
    {
        try {
            $resources = $this->paymentResources->statusUpdate();
            $payment = $this->paymentService->setModel($payment)->update([
                'status' => $request->get('status'),
            ],events: [
                PaymentStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $payment->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(PaymentDestroyRequest $request,Payment $payment)
    {
        try {
            $resources = $this->paymentResources->destroy();
            $payment = $this->paymentService->setModel($payment)->delete(events: [
                PaymentDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->destroy(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $payment->responseTitles(ResponseTitle::DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function restore(PaymentRestoreRequest $request,string|int $id)
    {
        try {
            $resources = $this->paymentResources->restore();
            $payment = $this->paymentService->restore(id: $id,idColumn: config('callmeaf-payment.resources.restore.id_column'),events: [
                PaymentRestored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_restored',[
                'title' =>  $payment->responseTitles(ResponseTitle::RESTORE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function trashed(PaymentTrashedIndexRequest $request)
    {
        try {
            $resources = $this->paymentResources->trashed();
            $payments = $this->paymentService->onlyTrashed()->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes(),events: [
                PaymentTrashed::class,
            ]);
            return apiResponse([
                'payments' => $payments,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function forceDestroy(PaymentForceDestroyRequest $request,string|int $id)
    {
        try {
            $resources = $this->paymentResources->forceDestroy();
            $payment = $this->paymentService->forceDelete(id: $id,idColumn: $resources->idColumn(),columns: $resources->columns(),events: [
                PaymentForceDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_force_destroyed',[
                'title' =>  $payment->responseTitles(ResponseTitle::FORCE_DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function documentsUpdate(PaymentDocumentsUpdateRequest $request,Payment $payment)
    {
        try {
            $resources = $this->paymentResources->documentsUpdate();
            $payment = $this->paymentService->setModel($payment)->createMultiMedia(
                files: $request->file('documents'),
                collection: MediaCollection::DOCUMENTS,
                disk: MediaDisk::PAYMENTS,
                events: [
                    PaymentDocumentsUpdated::class,
                ],
            )->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $payment,
            ],__('callmeaf-base::v1.successful_updated_non_title'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


}
