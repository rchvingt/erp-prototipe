<script>
    $(document).ready(function() {
        // Select All Permissions
        $('#checkPermissionAll').on('change', function() {
            var isChecked = $(this).is(':checked');
            $('.form-check-input').prop('checked', isChecked);
            // Update grup checkbox setelah memilih semua
            $('.checkAll').prop('checked', isChecked);
        });

        // Select All for each group
        $('.checkAll').on('change', function() {
            var group = $(this).data('group'); // Mengambil nama group
            var isChecked = $(this).is(':checked');

            // Pilih semua permission yang ada dalam group ini
            $('.permission-' + group).prop('checked', isChecked);
        });

        // Cek status setiap group untuk menentukan apakah checkbox grup harus dicentang
        $('.permission-checkbox').on('change', function() {
            var group = $(this).data('group');
            checkGroupStatus(group);
        });

        // Fungsi untuk mengecek status grup
        function checkGroupStatus(group) {
            var allChecked = true;
            $('.permission-' + group).each(function() {
                if (!$(this).is(':checked')) {
                    allChecked = false;
                }
            });
            // Update checkbox grup berdasarkan status permissions
            $('.checkAll[data-group="' + group + '"]').prop('checked', allChecked);
        }

        // Cek setiap group pada saat halaman dimuat
        $('.checkAll').each(function() {
            var group = $(this).data('group');
            checkGroupStatus(group);
        });
    });
</script>
