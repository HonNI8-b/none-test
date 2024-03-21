// jQueryを使用してAjaxリクエストにCSRFトークンを追加する
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});