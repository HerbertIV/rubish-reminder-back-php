// import './bootstrap';
// import '../css/app.css';
// import '../css/tailwind.css';
// function dataTableController (id) {
//     return {
//         id,
//         deleteItem() {
//             Swal.fire({
//                 title: 'Are you sure?',
//                 text: "You won't be able to revert this!",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Yes, delete it!'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     Livewire.emit('deleteItem', this.id);
//                 }
//             })
//         }
//     }
// }
//
// function dataTableMainController () {
//     return {
//         setCallback() {
//             Livewire.on('deleteResult', (result) => {
//                 if (result.status) {
//                     Swal.fire(
//                         'Deleted!',
//                         result.message,
//                         'success'
//                     );
//                 } else {
//                     Swal.fire(
//                         'Error!',
//                         result.message,
//                         'error'
//                     );
//                 }
//             });
//         }
//     }
// }
//

function select2Ajax() {
    $('[data-ajax-select2]').each(function(){
        let url = $(this).attr('data-ajax-select2-url');
        let searchingText = $(this).attr('data-searching-text');
        let noResultFoundText = $(this).attr('data-no-result-found-text');
        let selectedValue = false;
        let select2Conf = {
            language: {
                searching: function() {
                    return searchingText;
                },
                "noResults": function(){
                    return noResultFoundText;
                }
            },
            ajax: {
                url: url,
                dataType: 'json',
                processResults: function (data, params) {
                    return {
                        results: data.data,
                    };
                },
                transport: function (params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail('test');
                    return $request;
                }
            },
            templateResult: formatRepo,
            templateSelection: formatRepo
        };
        if ($(this).attr('data-selected-items')) {
            select2Conf.data = JSON.parse($(this).attr('data-selected-items'));
            selectedValue = true;
        }
        $(this).select2(select2Conf);
        if (selectedValue) {
            $(this).val(select2Conf.data.map((element) => {
                return element.id;
            })).trigger('change');
        }
        $(this).on('change', function (e) {
            livewire.emit('selectedCompanyItem', e.target.value)
        });
        window.livewire.on('select2',()=>{
            initSelectCompanyDrop();
        });
    });
}

function clearSelect2()
{
    $(document).on('click', '[data-select2-clear]', function () {
        $(this).siblings('select').val(null).trigger('change');
    });
}


function formatRepo(repo) {
    return repo.template ? $(repo.template) : repo.text;
}

function toggleBulkActions()
{
    $(document).on('click', '#table-bulkActionsDropdown', () => {
        $('[aria-labelledby="table-bulkActionsDropdown"]').toggleClass('d-block')
    });
}

$(document).ready(function() {
    select2Ajax();
    clearSelect2();
    toggleBulkActions();
});
