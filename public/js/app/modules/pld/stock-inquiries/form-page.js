
let FormPage = (function() {

    let inquiry;
    let detailForm;
    let detailTable;

    function init(inquiryRef, detailTableRef, detailFormRef) {
        inquiry = inquiryRef;
        detailForm = detailFormRef;
        detailTable = detailTableRef;

        detailTable.setRows(inquiry.details);

        detailForm.setOnSaveListener(function(saveMode, data) {
            console.log('data', data);
            if (saveMode == 'store') {
                detailTable.addRow(data);
            }

            if (saveMode == 'update') {
                detailTable.updateRow(data);
            }
        });

        initEvents();
    }

    function initEvents() {
        //  TODO: move this to detail table
        $(document).on('click', '[action=create-row]', function() {
            detailTable.refreshRowsView();
            detailForm.create();
        });

        $(document).on('click', '[action=view-row]', function() {
            detailTable.refreshRowsView();
            let id = $(this).data('id');
            $(`tr[data-id="${id}"]`).addClass('selected');
            detailForm.view(detailTable.getRowData(id));
        });

        $(document).on('click', '[action=edit-row]', function() {
            detailTable.refreshRowsView();
            let id = $(this).data('id');
            $(`tr[data-id="${id}"]`).addClass('selected');
            detailForm.edit(detailTable.getRowData(id));
        });

        $(document).on('click', '[action=delete-row]', function() {
            let id = $(this).data('id');
            detailTable.removeRow(id);
        });

        $(document).on('click', '[action=save]', function() {
            detailTable.refreshRowsView();
            inquiry.purpose = $('[name=inquiry]').val();
            inquiry.detailUpdates = detailTable.getTableData();
        });
    }

    return { init };
})();