
let FormPage = (function() {

    let inquiry;
    let DetailForm;
    let DetailTable;

    function init(inquiryRef, DetailTableRef, DetailFormRef) {
        inquiry = inquiryRef;
        DetailForm = DetailFormRef;
        DetailTable = DetailTableRef;

        DetailTable.setRows(inquiry.details);
        DetailTable.refreshRowsView();

        initEvents();
    }

    function initEvents() {
        $(document).on('click', '[action=view-row]', function() {
            let id = $(this).data('id');
            DetailForm.view(DetailTable.getRowData(id));
        });

        $(document).on('click', '[action=edit-row]', function() {
            let id = $(this).data('id');
            DetailForm.edit(DetailTable.getRowData(id));
        });

        $(document).on('click', '[action=delete-row]', function() {
            let id = $(this).data('id');
            DetailTable.removeRow(id);
        });
    }

    return { init };
})();