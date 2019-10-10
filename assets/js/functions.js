/*DATATABLE*/
function datatableApplyCandidates() {
        $('#table_id').DataTable({
        	/*TRADUÇÕES*/
        	"language": {
    		    "sEmptyTable": "Nenhum registro encontrado",
    		    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    		    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    		    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    		    "sInfoPostFix": "",
    		    "sInfoThousands": ".",
    		    "sLengthMenu": "_MENU_ Resultados por página",
    		    "sLoadingRecords": "Carregando...",
    		    "sProcessing": "Processando...",
    		    "sZeroRecords": "Nenhum registro encontrado",
    		    "sSearch": "Pesquisar",
    		    "oPaginate": {
    		        "sNext": "Próximo",
    		        "sPrevious": "Anterior",
    		        "sFirst": "Primeiro",
    		        "sLast": "Último"
    		    },
    		    "oAria": {
    		        "sSortAscending": ": Ordenar colunas de forma ascendente",
    		        "sSortDescending": ": Ordenar colunas de forma descendente"
    		    }
    		},
            "scrollY":        "1000px",
            "scrollX":        "1000px",
            "scrollCollapse": true,
            "paging":         true,
            "columnDefs": [
                { "width": "auto", targets: 0 },//N°
                { "width": "auto", targets: 1 },//idade
                { "width": "445px", targets: 2 },//nome
                { "width": "445px", targets: 3 },//mãe
                { "width": "auto", targets: 4 },//data-cadastro
                { "width": "150px", targets: 5 }//situação
            ],
            "fixedColumns": true
        });
}

function datatableApplyUsers() {
        $('#table_id').DataTable({
            /*TRADUÇÕES*/
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },/*SCROLLING*/
            "scrollY":        "1000px",
            "scrollX":        "1000px",
            "scrollCollapse": true,
            "paging":         true,
            "columnDefs": [
                { "width": "140px", targets: 0 },//img-edit
                { "width": "500px", targets: 1 },//nome
                { "width": "500px", targets: 2 },//email
                { "width": "140px", targets: 3 }//img-apagar
            ],
            "fixedColumns": true
        });
}

function datatableApplyClassrooms() {
        $('#table_id').DataTable({
            /*TRADUÇÕES*/
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },/*SCROLLING*/
            "scrollY":        "1000px",
            "scrollX":        "1000px",
            "scrollCollapse": true,
            "paging":         true,
            "columnDefs": [
                { "width": "140px", targets: 0 },//img-edit
                { "width": "500px", targets: 1 },//nome
                { "width": "500px", targets: 2 },//núm alunos
                { "width": "140px", targets: 3 }//img-apagar
            ],
            "fixedColumns": true
        });
}


/*MODAL TRIGGER*/
function modalHref(element) {

  // access element which fired event by > this
  var href = element.getAttribute('data-href');
  // Set attribute
  document.getElementsByClassName('btn-ok')[0].setAttribute('href', href);
}

function obsModal(element) {

  // access element which fired event by > this
  var id = element.getAttribute('data-id');
  var obs = element.getAttribute('data-obs');
  // Set attribute
  document.getElementById("cid").innerHTML = id;
  document.getElementById("obs").innerHTML = obs+"\n\nDESISTÊNCIA: ";
  // document.getElementsByClassName('btn-ok')[0].setAttribute('href', href);
}


/*PHONE MASK*/
function setupPhoneMaskOnField(selector){
  var inputElement = $(selector)

  setCorrectPhoneMask(inputElement);
  inputElement.on('input, keyup', function(){
    setCorrectPhoneMask(inputElement);
  });
}

function setCorrectPhoneMask(element){
    if (element.inputmask('unmaskedvalue').length > 10 ){
        element.inputmask('remove');
        element.inputmask('(99) [9]9999-9999')
    } else {
        element.inputmask('remove');
        element.inputmask({mask: '(99) 9999-9999[9]', greedy: false})
    }
}

function applyMask(){
    setupPhoneMaskOnField('#tel1');
    setupPhoneMaskOnField('#tel2');
}

/*TABLE ROW CUSTOM ANCHOR TO CANDIDATE DATA*/
function candidateData(element) {
  // access element which fired event by > this
  var href = "http://localhost/Monitoramento-EI/view/candidate_data.php?id="+element.getAttribute('data-href');
  window.location = href;
}

/*YEAR INPUT CATEGORIES*/
function inputYear(){
    document.querySelector("input[type=number]").oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
}