<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery-ui.min.js"></script>

<script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>

<script src="/assets/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js"></script>

<script src="/assets/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js"></script>

<script src="/assets/libs/datatables/plugins/responsive/js/responsive.dataTables.min.js"></script>
<script src="/assets/libs/datatables/plugins/responsive/js/responsive.bootstrap5.min.js"></script>
<script src="/assets/js/setup.js"></script>


@stack('libs-js')
<script src="/assets/js/tabler.min.js"></script>


<script>
    (function($) {
        $(function() {
            // tránh bind trùng lặp
            $(document).off('click.appDelete', '.btn-delete');
            $(document).on('click.appDelete', '.btn-delete', function(e) {
                e.preventDefault();
                try {
                    const $btn = $(this);
                    const row = $btn.closest('tr');
                    const url = $btn.attr('href');
                    if (!url) {
                        console.warn('btn-delete missing href');
                        return;
                    }

                    const notifySuccess = function(message) {
                        if (window.flasher) {
                            if (typeof window.flasher.success === 'function') {
                                window.flasher.success(message);
                                return;
                            }
                            if (typeof window.flasher.notify === 'function') {
                                window.flasher.notify('success', message);
                                return;
                            }
                        }
                        console.log(message);
                    };
                    const notifyError = function(message) {
                        if (window.flasher) {
                            if (typeof window.flasher.error === 'function') {
                                window.flasher.error(message);
                                return;
                            }
                            if (typeof window.flasher.notify === 'function') {
                                window.flasher.notify('error', message);
                                return;
                            }
                        }
                        console.error(message);
                    };

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            notifySuccess((response && response.message) ? response
                                .message : 'Xóa thành công');
                            if (row && row.length) {
                                row.remove();
                            }
                            $('.buttons-reload').trigger('click');
                        },
                        error: function(xhr) {
                            notifyError('Xóa thất bại');
                        }
                    });
                } catch (err) {
                    console.error('Delete handler error', err);
                }
            });
        });
    })(window.jQuery);
</script>

@stack('scripts')
