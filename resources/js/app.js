import iziToast from "izitoast";
import "izitoast/dist/css/iziToast.min.css"

function toastr() {
    document.querySelectorAll('[data-flash-message]').forEach((element) => {
        switch (element.getAttribute('data-flash-message-type')) {
            case 'success' :
                iziToast.success({
                    message: element.getAttribute('data-flash-message-content'),
                    position: 'topRight'
                });
                break;
            case 'error' :
                iziToast.error({
                    message: element.getAttribute('data-flash-message-content'),
                    position: 'topRight'
                });
                break;
        }

    })
}

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
            livewire.emit('selectedCompanyItem', e.target.name, e.target.value)
        });
        window.livewire.on('select2',()=>{
            initSelectCompanyDrop();
        });
    });
}

function select2InitEvents()
{
    $('[data-sync-select2]').each(function(){
        let select2Conf = {
            language: {
                searching: function() {
                    return searchingText;
                },
                "noResults": function(){
                    return noResultFoundText;
                }
            },
            templateResult: formatRepo,
            templateSelection: formatRepo
        };
        $(this).select2(select2Conf);
        $(this).on('change', function (e) {
            livewire.emit('selectedCompanyItem', e.target.name, e.target.value)
        });
        window.livewire.on('select2',() =>{
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

function toggleSwitcher()
{
    $(document).on('change', '[data-switcher]', (e) => {
        livewire.emit('toggleSwitcher', e.target.name, e.target.checked)
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
    toggleSwitcher();
    toastr();
    // new ScheduleCalendar('schedule');
});

Livewire.hook('component.initialized', function (component) {
    if (component.el.querySelector('[data-ajax-select2]')) {
        select2Ajax();
        clearSelect2();
    }
});
