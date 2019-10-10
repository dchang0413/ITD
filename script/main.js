function changeUser(path, params, method='post') {
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  var sel = document.getElementById("idpicker");
  var id = sel.options[sel.selectedIndex].value;

  const input = document.createElement('input');
  input.type='hidden';
  input.name = 'id';
  input.value = id;

  form.appendChild(input);

  document.body.appendChild(form);
  form.submit();
}
