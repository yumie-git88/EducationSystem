$(function() { //モーダル表示
  $('#registerModal').on('show.bs.modal', function (e) {
      let name = $('#name').val();
      let name_kana = $('#name_kana').val();
      let email = $('#email').val();
      let password = $('#password').val();
      let modal = $(this);
      modal.find('#modalName').text(name);
      modal.find('#modalKana').text(name_kana);
      modal.find('#modalEmail').text(email);
      // modal.find('#modalPassword').text(password);
  });
});