"use strict";

Window.Laravel = {
    paginationClass: 'page-link',
    listClass: '__data_list',
    selfUser: '',
    role: '',
    selfId: '',
};

/**
 * Ajax Request
 *
 * @param url
 * @param type
 * @param data
 * @param loading
 * @param form
 * @param file
 *
 * @returns {Promise<void>}
 */
const ajaxRequest = async function (url, type, data, loading = true, form = null, file = false) {
    setHeaders();
    let settings = {
        url: url,
        type: type,
        data: data,
        processData: true,
        beforeSend: () => {
            (loading) ? preLoader('show') : '';
        },

        success: (res) => {
            (loading) ? preLoader('hide') : '';

            if (!res.status) {
                if (res.message !== undefined)
                    if (res.message !== '' && res.message !== null){
                        notifier('error',errorIcon(res.message));
                    }

                return false;
            }

            if (res.status) {
                if (res.message !== undefined)
                    if (res.message !== '' && res.message !== null)
                        notifier('success',successIcon(res.message));

                return res;
            }
        },

        error: (err) => {
            (loading) ? preLoader('hide') : '';

            if (err.status === 422) {
                let errors = (err.responseJSON)
                    ? err.responseJSON.errors
                    : JSON.parse(err.responseText).errors;

                populateErrors(form, errors);
                return;
            }

            if (err.responseJSON.message !== '' && err.responseJSON.message !== null) {
                notifier('error',errorIcon(err.responseJSON.message));
            }
        }
    };


    if (file !== false) {
        settings.processData = false;
        settings.contentType = false;
    }

    return $.ajax(settings);
};

/**
 * Pre Loader Control
 *
 * @param state
 */
const preLoader = function (state) {
    let loader = $('body').find('#pageloader');
    if (state === 'show') {
        return setTimeout(function () {
            loader.show();
        }, 3500);
    }

    loader.hide();
};

/**
 * Set Default Request Headers
 */
const setHeaders = function () {
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
    });
};

/**
 * @param selector
 * @param allowTime
 * @param allowOnlyTime
 * @param minDate
 */
const enableDatePicker = (selector, allowTime = true, minDate = true, allowOnlyTime = false) => {

    let settings = {
        language: 'en',
        timepicker: allowTime,
        classes: allowOnlyTime ? 'only-timepicker' : ''
    };

    allowOnlyTime ? settings.dateFormat = ' ' : settings.dateFormat = 'yyyy-mm-dd';
    minDate ? settings.minDate = new Date() : '';
    $(selector).datepicker(settings);

    if (allowOnlyTime)
        $('body').find('.only-timepicker .datepicker--content, .datepicker--nav').css({
            display: 'none'
        });
};

/**
 *
 * @param num
 * @returns {string}
 */
const numberFormat = (num) => {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
};

/**
 *
 * @param key
 * @param value
 */
const insertParam = (key, value) => {
    key = encodeURI(key);
    value = encodeURI(value);
    let kvp = document.location.search.substr(1).split('&');
    let i = kvp.length;
    let x;
    while (i--) {
        x = kvp[i].split('=');
        if (x[0] === key) {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if (i < 0) {
        kvp[kvp.length] = [key, value].join('=');
    }
    //this will reload the page, it's likely better to store this until finished
    return kvp.join('&');
};

/**
 *
 * @param form
 * @param data
 */
const populateFields = function (form, data) {
    $.each(data, function (key, value) {
        let ctrl = $('[name=' + key + ']', form);
        switch (ctrl.prop("type")) {
            case "radio":
            case "checkbox":
                ctrl.each(function () {
                    if ($(this).attr('value') === value) $(this).attr("checked", value);
                });
                break;
            default:
                ctrl.val(value);
        }
    });
};

/**
 * Form Errors Populator
 *
 * @param form
 * @param errors
 */
const populateErrors = function (form, errors) {
    let toastrPopulate = false;
    $.each(errors, function (key, message) {
        $(form).find(`.error-${key}`).remove();
        let Array_key = key + "[]";
        let $selector = $(form).find(`input[name="${key}"], input[name="${Array_key}"], textarea[name="${key}"], select[name="${key}"], select[name="${Array_key}"]`);
        {
            if ($selector.hasClass('select2-hidden-accessible'))
                $selector = $selector.next();
        }

        if ($selector.length < 1 && !toastrPopulate) {
            toastrPopulate = true;
            notifier('error',errorIcon("Please check required fields."));
            return;
        }

        if ($selector.attr('type') == 'checkbox') {
            $selector.next().after(`<br><label class="error error-${key}">${message}</label>`);
        } else {
            $selector.after(`<label class="error error-${key}">${message}</label>`);
        }
        $selector.trigger('focus');
    });

};

/**
 *
 * @param message
 * @returns {*}
 */
const confirm = function (message) {
    return swal({
        title: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonClass: 'btn btn-success mr-5',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function (isConfirm) {
        return !!(isConfirm);
    });
};

/**
 *
 * @returns {{serverSide: boolean, processing: boolean}}
 */
const dataTableSettings = function () {
    return {
        serverSide: true,
        processing: true,
    };
};

/**
 *
 * @param selector
 * @param url
 * @param column
 * @param columnDef
 * @param target
 */
const dataTables = function (selector, url, column = null, columnDef = null, target = null) {
    let columns = column === null ? setBySelector(selector) : pushColumns(column);
    let settings = dataTableSettings();
    $(selector).DataTable({
        serverSide: settings.serverSide,
        processing: settings.processing,
        "ajax": {
            "url": url
        },
        "columns": columns,
        columnDefs: columnDef
    });
};

/**
 *
 * @param column
 * @returns {[]}
 */
const pushColumns = function (column) {
    let columns = [];
    column.forEach(col => {
        columns.push({data: col});
    });
    return columns;
};

/**
 *
 * @param selector
 * @returns {*[]}
 */
const setBySelector = function (selector) {
    let columns = [];
    $(selector).find('th').each((i, a) => {
        if ($(a).text() !== 'action') {
            columns.push($(a).text().replace(/\s+/g, '_').toLowerCase());
        }
    });
    return pushColumns(columns);
};

/**
 *
 * @param selector
 */
const scrollDown = (selector) => {
    selector.animate({scrollTop: selector[0].scrollHeight});
};

/**
 *
 * @param value
 * @param phrase
 * @returns {string}
 */
const str_formatting = (value, phrase) => {
    return value < 1 ? 'Studio' : (value > 1 ? value + ' ' + phrase + "s" : value + ' ' + phrase);
};

/**
 * Toggle eye view
 */
const toggleEye = ($event) => {
    $event.toggleClass('fa-eye-slash');
    if ($event.hasClass('fa-eye-slash')) {
        $event.siblings('input').attr('type', 'text');
    } else {
        $event.siblings('input').attr('type', 'password');
    }
};


$(() => {

    // Enable Loader On Each Page
    preLoader('show');

    let $body = $('body');

    // Form Submit
    $body.on('submit', '.ajax', async function (e) {
        e.preventDefault();
        let data = null, form = $(this), id = $(this).attr('id');
        let url = $(this).attr('action'), type = $(this).attr('method');
        let loading = $(this).attr('loading'), reset = $(this).attr('reset');
        let file = $(this).attr('enctype') !== undefined;
        $body.find('.error').removeClass('error-*').text('');

        if (!file)
            data = $(this).serialize();

        else {
            let files = $(this).find('input[type=file]'), fd = new FormData();

            if (files.length > 0) {
                $.each(files, (i, v) => {
                    let uploadedFiles = $(`input[name="${$(v).attr('name')}"]`)[0].files;
                    for (let j = 0; j < uploadedFiles.length; j++) {
                        fd.append($(v).attr('name'), uploadedFiles[j]);
                    }
                });
            }

            data = $(this).serializeArray();

            if (data.length > 0) {
                data.forEach(v => {
                    fd.append(v.name, v.value);
                });
            }

            data = fd;
        }

        // if (!form.valid()) return;
        await ajaxRequest(url, type, data, (loading !== 'false'), form, file).then(res => {

            if (reset === 'true') {
                let iVal = $(form).find('input[type=submit]').val();
                $(form).find('input, select, textarea').val('');
                $(form).find('input[type=submit]').val(iVal)
            }

            if (res.status)
                form.trigger(`form-success${id !== undefined ? '-' + id : ''}`, res.data);
            if (res.url !== undefined) {
                $('.ajax').find('button').prop('disabled',true);//disable button on response
                if (res.url !== null) {

                    // This is only payTabs
                    if(res.success == 'payTabs')
                    {
                        window.location.href = res.url
                    }

                    setTimeout(() => {
                        window.location.href = res.url
                    }, 3000);
                    return;
                }

                setTimeout(() => {
                    window.location.reload()
                }, 3000);
            }

            if (res.view !== undefined)
                $body.find(`.${Window.Laravel.listClass}`).html(res.view);

        }).catch(err => {
            // Do Something
        });
    });

    // Pagination
    $body.on('click', `.${Window.Laravel.paginationClass}`, async function (e) {
        e.preventDefault();
        let href = $(this).attr('href')
        if (href === undefined)
            return;

        await ajaxRequest(href, 'GET', null, true).then(res => {
            $body.find(`.${Window.Laravel.listClass}`).html(res.view);
        });
    });

    $body.on('click', '.delete-image-media', function (e) {
        let container = $(this).parent('.__live_image');
        container.prev().val('');
        container.remove();
    });

    // Image Enlarge
    $('img[data-enlargeable]').addClass('img-enlargeable').click(function () {
        let src = $(this).attr('src'), modal;

        function removeModal() {
            modal.remove();
            $('body').off('keyup.modal-close');
        }

        modal = $('<div>').css({
            background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
            backgroundSize: 'contain',
            width: '100%', height: '100%',
            position: 'fixed',
            zIndex: '10000',
            top: '0', left: '0',
            cursor: 'zoom-out'
        }).click(function () {
            removeModal();
        }).appendTo('body');
        //handling ESC
        $body.on('keyup.modal-close', function (e) {
            if (e.key === 'Escape') {
                removeModal();
            }
        });
    });

    // LiveImage Preview
    $body.on('input', `input[data-preview-file-type=text]`, async function (e) {
        let file = e.target.files[0], reader = new FileReader();
        let $selector = $(this);
        reader.onload = function (e) {

            if ($selector.parent().find('.__live_image').length < 1)
                $selector.after(`
                    <div class="__live_image" style="width: 170px">
                        <span class="danger remove-img remove-img-style delete-image-media" data-value="2" style="left: 138px; top: 39px; background-color: #bf0000; color: white">x</span>
                        <img src="${e.target.result}" attr="display" style="padding: 10px;max-height: 100px;max-width: 150px;border-color: black;border: 1px solid;margin-top: 10px;height: 100px;width: 150px;">
                    </div>`);
            else
                $selector.parent().find('.__live_image').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

    $body.on('click', '.i-Close-Window', function (e) {
        let parent_div = $(this).parent();
        e.preventDefault();
        swal({
            title: 'Are you sure you want to remove?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(async function () {
            if (parent_div.attr("id") === 'force') {
                window.location = parent_div.attr('href');
            } else {
                parent_div.addClass('remove-item');
                $(".remove-item").trigger("click");
                parent_div.removeClass('remove-item');
            }
        }, function (dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your record is safe :)',
                    'error'
                )
            }
        })
    });

});

/**
 * Disable loader on page Loaded
 */
window.onload = function () {
    setTimeout(() => {
        preLoader('hide')
    }, 500);
};

/**
 * @author Shaarif m.shaarif@xintsolutions.com
 * @param type
 * @param message
 * @var Notification function
 */
const notifier = (type,message) => {
    new Noty({
        type: type,
        layout: 'topRight',
        theme: 'metroui',
        timeout: 3000,
        progressBar: true,
        text: '<i>'+ message +'</i>'
    }).show();
}

/**
 * @author Ayesha
 * @param message
 * @returns {string}
 */
const errorIcon = (message) => {
    return '<div class="d-flex align-items-center gap-3"><span class="material-symbols-outlined">warning</span>' + message + '</div>';
}

/**
 * @author Ayesha
 * @param message
 * @returns {string}
 */
const successIcon = (message) => {
    return '<div class="d-flex align-items-center gap-3"><span class="material-symbols-outlined">done</span>' + message + '</div>';
}
