
let DetailTableBuilder = (function() {

    function build() {
        let rowRenderer = (rowViewData) => {
            rowViewData.badgeClass = getRowBadgeClass(rowViewData);
            return tmpl('tmpl-detail-row', rowViewData);
        };

        let rowIdFetcher = (row) => {
            return row.item.code;
        };

        detailTable = new EditableTable('#detail-rows-container', rowRenderer, rowIdFetcher);    
        detailTable.setDetailFormClass(DetailForm, [this.suppliers]);
        return detailTable;
    }

    function withSuppliers(suppliers) {
        this.suppliers = suppliers;
        return this;
    }

    function getRowBadgeClass(row) {
        if (row.status == 'Incomplete / Out of Stock') {
            return 'badge-danger';
        }

        return 'badge-primary';
    }

    return { withSuppliers, build };

})();