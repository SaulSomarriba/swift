<div class="modal fade in" id="create-worker">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('staff/create_worker.title')</h4>
      </div>
      <div class="modal-body">
        <div class="row form-inline">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-worker-name" class="control-label">@lang('staff/create_worker.name')</label>
            <input type="text" class="form-control" id="create-worker-name">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-worker-id" class="control-label">@lang('staff/create_worker.legal_id')</label>
            <input type="text" class="form-control" id="create-worker-id">
          </div>
        </div>
        <div class="row form-inline lg-top-space md-top-space sm-top-space">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-worker-job-title" class="control-label">@lang('staff/create_worker.job_title')</label>
            <input type="text" class="form-control" id="create-worker-job-title">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-worker-phone" class="control-label">@lang('staff/create_worker.phone')</label>
            <input type="text" class="form-control" id="create-worker-phone">
          </div>
        </div>
        <div class="row form-inline lg-top-space md-top-space sm-top-space">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center sm-top-space">
            <label for="create-worker-branch" class="control-label">@lang('staff/create_worker.branch')</label>
            <select class="form-control" id="create-worker-branch">
              @foreach(\App\Branch::all()  as $branch)
                <option value="{{ $branch->code }}">{{ $branch->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('staff/create_worker.close')</button>
        <button type="button" class="btn btn-primary" id="create-worker-create">@lang('staff/create_worker.create')</button>
      </div>
    </div>
  </div>
</div>
