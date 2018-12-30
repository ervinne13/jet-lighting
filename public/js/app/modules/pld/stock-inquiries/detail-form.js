
class DetailForm extends EditableTableForm {

    constructor(suppliers) {
        super();

        this.supplierMap = [];
        suppliers.forEach(supplier => {
            this.supplierMap[supplier.id] = supplier;
        });
    }

    static get templateId() {
        return 'tmpl-detail-form';
    }

    display(data) {        
        $('#detail-rows-container').append(tmpl(DetailForm.templateId, data));
    }

    getBlankData() {
        return {
            itemCode: null,
            neededQuantity: 1,
            onHandQuntity: 0,
            supplierId: null,
            supplierQuantity: 0,
            supplierUnitCost: 0
        };
    }

    getFormData() {
        let data = super.getFormData();

        let itemCode = $('[name=item_code]').val();
        let supplierId = $('[name=supplier_id]').val();
        data.item = itemCode ? ItemSelection.getItemByCode(itemCode) : null;
        data.supplier = supplierId ? this.supplierMap[supplierId] : null;

        return data;
    }
}