/*
  Accounts Object.
*/
function Account() {
  view_account = {};
  report_account = {};
}

Account.prototype = {
  constructor: Account,
  verify_account_data: function(a) {
    if(a.code == '') {
      swift_utils.display_error(swift_language.get_sentence('create_account_blank_code'));
      return false;
    }
    if(a.name == '') {
      swift_utils.display_error(swift_language.get_sentence('create_account_blank_name'));
      return false;
    }
    if(a.amount == '' || !$.isNumeric(a.amount)) {
      swift_utils.display_error(swift_language.get_sentence('create_account_amount_error'));
      return false;
    }
    return true;
  },
  create_account: function(e) {
    // Make target busy and get relevant data.
    swift_utils.busy(e.target);
    var account_data = {
        'code': $('#create-account-code').val(),
        'name': $('#create-account-name').val(),
        'type': $('#create-account-type').val(),
        'children': $('#create-account-children').val(),
        'parent': $('#create-account-parent').val(),
        'amount': $('#create-account-amount').val(),
      };

    // Check if data is correct and create it if it is.
    if(this.verify_account_data(account_data)) {
      var request = $.post('/swift/accounting/create_account', { account: account_data, _token: swift_utils.swift_token() });
      request.done(function(data) {
        swift_utils.free(e.target);
        if(data['state'] != 'Success') {
          swift_utils.display_error(data.error);
          return;
        }
        $('#create-account').modal('hide');
        swift_utils.display_success(data['message']);
      });
      request.fail(function(ev) {
        swift_utils.free(e.target);
        swift_utils.ajax_fail(ev);
      });
    } else {
      swift_utils.free(e.target);
    }
  },
  change_code: function(e) {
    var code = $('#account-code').val();
    var type = $('#account-type').val();
    this.load_accounts({'code': code, 'type': type}, e);
  },
  change_type: function(e) {
    // Clear code and get type.
    $('#account-code').val('');
    var type = $('#account-type').val();
    this.load_accounts({'code': '', 'type': type}, e);
  },
  load_accounts: function(a, e) {
    var request = $.post('/swift/accounting/load_accounts', { account_data: a, _token: swift_utils.swift_token() });
    request.done(function(data) {
      swift_utils.free(e.target);
      $('#accounts-body').empty();
      $('#accounts-body').append(data);
    });
    request.fail(function(ev) {
      swift_utils.free(e.target);
      swift_utils.ajax_fail(ev);
    });
  },
  load_ledger: function(e) {
    if($('#account-ledger-code').val() == '') {
      swift_utils.display_error(swift_language.get_sentence('create_account_blank_code'));
      return;
    }
    var ledger_data = {
      'code': $('#account-ledger-code').val(),
      'date_range': $('#account-ledger-date-range').val(),
      'offset': 0
    }
    var request = $.post('/swift/accounting/load_ledger', { ledger_data: ledger_data, _token: swift_utils.swift_token() });
    request.done(function(data) {
      swift_utils.free(e.target);
      $('#ledger-table-body').empty();
      $('#ledger-table-body').append(data);
    });
    request.fail(function(ev) {
      swift_utils.free(e.target);
      swift_utils.ajax_fail(ev);
    });
  },
  ledger_pagination: function() {
    // TODO: Implement Pagination for ledger.
  },
  download_ledger: function() {
    if($('#account-ledger-code').val() == '') {
      swift_utils.display_error(swift_language.get_sentence('create_account_blank_code'));
      return;
    }
    var ledger_data = {
      'code': $('#account-ledger-code').val(),
      'date_range': $('#account-ledger-date-range').val()
    }
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host
    window.open(baseUrl+'/swift/accounting/download_ledger?ledger_data='+JSON.stringify(ledger_data), '_blank')
  },
  print_ledger: function(e) {
    if($('#account-ledger-code').val() == '') {
      swift_utils.display_error(swift_language.get_sentence('create_account_blank_code'));
      return;
    }
    var ledger_data = {
      'code': $('#account-ledger-code').val(),
      'date_range': $('#account-ledger-date-range').val()
    }
    var request = $.post('/swift/accounting/print_ledger', { ledger_data: ledger_data, _token: swift_utils.swift_token() });
    request.done(function(data) {
      swift_utils.free(e.target);
      $('.print_area').empty();
      $('.print_area').append(data);
      window.print();
    });
    request.fail(function(ev) {
      swift_utils.free(e.target);
      swift_utils.ajax_fail(ev);
    });
  },
}

var accounts_js = new Account();

// Define Modal Event Listeners.
swift_event_tracker.register_swift_event(
  '#create-account-create',
  'click',
  accounts_js,
  'create_account');

$(document).on('click', '#create-account-create', function(e) {
  swift_event_tracker.fire_event(e, '#create-account-create');
});

swift_event_tracker.register_swift_event(
  '#account-type',
  'change',
  accounts_js,
  'change_type');

$(document).on('change', '#account-type', function(e) {
  swift_event_tracker.fire_event(e, '#account-type');
});

swift_event_tracker.register_swift_event(
  '#account-code',
  'change',
  accounts_js,
  'change_code');

$(document).on('change', '#account-code', function(e) {
  swift_event_tracker.fire_event(e, '#account-code');
});

swift_event_tracker.register_swift_event(
  '#account-ledger-search',
  'click',
  accounts_js,
  'load_ledger');

$(document).on('click', '#account-ledger-search', function(e) {
  swift_event_tracker.fire_event(e, '#account-ledger-search');
});

swift_event_tracker.register_swift_event(
  '#ledger-print',
  'click',
  accounts_js,
  'print_ledger');

$(document).on('click', '#ledger-print', function(e) {
  swift_event_tracker.fire_event(e, '#ledger-print');
});

swift_event_tracker.register_swift_event(
  '#ledger-download',
  'click',
  accounts_js,
  'download_ledger');

$(document).on('click', '#ledger-download', function(e) {
  swift_event_tracker.fire_event(e, '#ledger-download');
});

$(function() {
  $('#account-code').autocomplete({
    // Get the suggestions.
    source: function (request, response) {
      $.post('/swift/accounting/suggest_accounts',
      { code: request.term,
        type: $('#account-type').val(),
        _token: swift_utils.swift_token()
      },
      function (data) {
          response(data);
      });
    },
    minLength: 2
  });
  $('#account-ledger-code').autocomplete({
    // Get the suggestions.
    source: function (request, response) {
      $.post('/swift/accounting/suggest_accounts',
      { code: request.term,
        type: 'all',
        _token: swift_utils.swift_token()
      },
      function (data) {
          response(data);
      });
    },
    minLength: 2
  });
});
// Define Menu Tab Events.
swift_event_tracker.register_swift_event('#accounts-view-accounts-tab', 'click', swift_menu, 'select_submenu_option');
$(document).on('click', '#accounts-view-accounts-tab', function(e) {
  swift_event_tracker.fire_event(e, '#accounts-view-accounts-tab');
});

swift_event_tracker.register_swift_event('#accounts-ledger-tab', 'click', swift_menu, 'select_submenu_option');
$(document).on('click', '#accounts-ledger-tab', function(e) {
  swift_event_tracker.fire_event(e, '#accounts-ledger-tab');
});