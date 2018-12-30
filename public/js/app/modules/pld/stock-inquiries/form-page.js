
let FormPage = (function() {

    let inquiry;
    let detailTable;

    function init(inquiryRef, detailTableRef) {
        inquiry = inquiryRef;
        detailTable = detailTableRef;

        detailTable.setRows(inquiry.details);        

        initEvents();
    }

    function initEvents() {
        $(document).on('click', '[action=save]', function() {
            detailTable.refreshRowsView();
            inquiry.purpose = $('[name=inquiry]').val();
            inquiry.detailUpdates = detailTable.getTableData();
        });
    }

    return { init };
})();