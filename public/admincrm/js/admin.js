$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if(link == location2){
            $(this).addClass('active');
        }
    });
})

$('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var cat_id = button.data('catid')
    var divinfo = document.getElementById('infotext')
    var emp_name = button.data('emp_name')
    var text = '<p>Delete \"' + emp_name + '\"</p>'
    divinfo.innerHTML = text
    var modal = $(this)
    modal.find('.modal-body #cat_id').val(cat_id);
})


    $(document).ready(function() {
        $('table.projects').DataTable()({

        });

    } );

$(document).ready(function(){
    $("#phone").mask("+38(999)999-99-99")
});
