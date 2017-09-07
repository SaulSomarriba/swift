@php
  // Get data we need to display.
  use App\Configuration;

  $config = Configuration::find(1);
  $modules = json_decode($config->modules);
@endphp
<div class="modal fade in" id="create-bank-account">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('accounting/create_account.title')</h4>
      </div>
      <div class="modal-body">
        <div class="row form-inline">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-bank-account-code" class="control-label">@lang('accounting/create_bank_account.code')</label>
            <input type="text" class="form-control" id="create-bank-account-code">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-bank-account-curreny" class="control-label">@lang('accounting/create_bank_account.currency')</label>
            <select class="form-control" id="create-bank-account-currency">
              @foreach(\App\Currency::all() as $currency)
                <option value="{{ $currency->code }}">{{ $currency->description }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row form-inline lg-top-space md-top-space sm-top-space">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-bank-account-name" class="control-label">@lang('accounting/create_bank_account.name')</label>
            <input type="text" class="form-control" id="create-bank-account-name">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-bank-account-number" class="control-label">@lang('accounting/create_bank_account.number')</label>
            <input type="text" class="form-control" id="create-bank-account-number">
          </div>
        </div>
        <div class="row form-inline lg-top-space md-top-space sm-top-space">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-bank-account-account" class="control-label">@lang('accounting/create_bank_account.account')</label>
            <input type="text" class="form-control" id="create-bank-account-account">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <label for="create-bank-account-balance" class="control-label">@lang('accounting/create_bank_account.balance')</label>
            <input type="text" class="form-control" id="create-bank-account-balance">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('accounting/create_bank_account.close')</button>
        <button type="button" class="btn btn-primary" id="create-bank-account-create">@lang('accounting/create_bank_account.create')</button>
      </div>
    </div>
  </div>
</div>
