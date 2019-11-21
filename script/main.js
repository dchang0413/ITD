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

function changeSchedTab(day){
    var tempcell, temphead;
    for(i = 1; i < 7; i++){
        temphead = document.getElementById('SchedHead'+i);
        tempcell = document.getElementById('SchedCell'+i);

        if (temphead.classList.contains('ScheduleHeadSel')) temphead.classList.remove('ScheduleHeadSel');
        tempcell.style.display = 'none';
        tempcell.colSpan = '1';
    }

    var header = document.getElementById('SchedHead'+day);
    var cell = document.getElementById('SchedCell'+day);

    header.classList.add('ScheduleHeadSel');
    cell.style.display = 'table-cell';
    cell.colSpan = "6";
}

function changeSchedTab2(day){
    var tempcell, temphead;
    for(i = 1; i < 7; i++){
        temphead = document.getElementById('SchedHead2'+i);
        tempcell = document.getElementById('SchedCell2'+i);

        if (temphead.classList.contains('ScheduleHeadSel')) temphead.classList.remove('ScheduleHeadSel');
        tempcell.style.display = 'none';
        tempcell.colSpan = '1';
    }

    var header = document.getElementById('SchedHead2'+day);
    var cell = document.getElementById('SchedCell2'+day);

    header.classList.add('ScheduleHeadSel');
    cell.style.display = 'table-cell';
    cell.colSpan = "6";
}

function confirmClasses(id){
    const form = document.createElement('form');
    form.method = 'post';
    form.action = '';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'confirmation';
    input.value = id;

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}

function returnHome(id){
      const form = document.createElement('form');
      form.method = 'post';
      form.action = '';

      const input = document.createElement('input');
      input.type='hidden';
      input.name = 'id';
      input.value = id;

      form.appendChild(input);

      document.body.appendChild(form);
      form.submit();
}
