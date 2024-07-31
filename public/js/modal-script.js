$(function() { //モーダル表示
  $('#registerModal').on('show.bs.modal', function (e) {
    let isValid = validateForm();
    if (isValid) {
      let name = $('#name').val();
      let name_kana = $('#name_kana').val();
      let email = $('#email').val();
      let password = $('#password').val();
      let modal = $(this);
      modal.find('#modalName').text(name);
      modal.find('#modalKana').text(name_kana);
      modal.find('#modalEmail').text(email);
      // modal.find('#modalPassword').text(password);
      console.log('バリデーション成功');
    } else {
      // $("#registerModal").modal("hide");
      alert('入力エラー：すべての項目を入力してください');
      e.preventDefault();
    }
  });
});

function validateForm(e) { //バリデーション
  if(document.getElementById("name").value === "") {
    // $('#registerModal').closest('hide.bs.modal');
    return false;
  } else if(document.getElementById("name_kana").value === "") {
    return false;
  } else if(document.getElementById("email").value === "") {
    return false;
  } else if(document.getElementById("password").value === "") {
    return false;
  } else {
    return true; // すべてのチェックがパスした場合は true を返す
  }
}
