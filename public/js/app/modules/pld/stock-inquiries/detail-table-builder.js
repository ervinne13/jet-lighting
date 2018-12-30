
let DetailTableBuilder = (function() {

    let suppliers;

    function build() {
        let rowRenderer = (rowViewData) => {
            rowViewData.badgeClass = getRowBadgeClass(rowViewData);
            return tmpl('tmpl-detail-row', rowViewData);
        };

        let rowIdFetcher = (row) => {
            return row.item.code;
        };

        let detailForm = new DetailForm(suppliers);
        detailForm.setCreateFormContainerSelector('.create-detail-form-container');        

        let detailTable = new EditableTable('#detail-rows-container', rowRenderer, rowIdFetcher);
        detailTable.setRowSpan(6);
        detailTable.setDetailForm(detailForm);
        return detailTable;
    }

    function withSuppliers(suppliersRef) {
        suppliers = suppliersRef;
        return DetailTableBuilder;
    }

    function getRowBadgeClass(row) {
        if (row.status == 'Incomplete / Out of Stock') {
            return 'badge-danger';
        }

        return 'badge-primary';
    }

    return { withSuppliers, build };

})();