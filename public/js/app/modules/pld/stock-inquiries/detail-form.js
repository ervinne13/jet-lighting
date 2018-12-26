
let DetailForm = (function() {

    let supplierMap = [];
    let onSaveListener;

    let ItemSelection;

    let saveMode = null;

    let formTmplId = 'tmpl-detail-form';

    function init(suppliers, ItemSelectionRef, onSaveListenerRef) {        
        ItemSelection = ItemSelectionRef;
        onSaveListener = onSaveListenerRef;

        suppliers.forEach(supplier => {
            supplierMap[supplier.id] = supplier;
        });

        initEvents();
    }

    function initEvents() {
        $(document).on('click', '.detail-action[action=close-detail]', function() {
            close();
        });

        $(document).on('click', '.detail-action[action=save-detail]', function() {
            if (onSaveListener) {                
                onSaveListener(saveMode, getData());
            } else {
                console.log('ghjkl;');
            }    
        });
    }

    function setOnSaveListener(onSaveListenerRef) {  
        onSaveListener = onSaveListenerRef;
    }

    function view(data) {
        saveMode = null;
        display(data);
    }

    function edit(data) {
        saveMode = 'update';
        display(data);
    }

    function create() {
        saveMode = 'store';        
        display(getBlank());
    }

    function close() {
        $('tr.form-row').remove();
    }

    function display(data) {        
        $('#detail-rows-container').append(tmpl(formTmplId, data));
    }

    function getData() {
        let data = getBlank();

        let itemCode = $('[name=item_code]').val();
        let supplierId = $('[name=supplierId]').val();
        data.item = itemCode ? ItemSelection.getItemByCode(itemCode) : null;
        data.supplier = supplierId ? supplierMap[supplierId] : null;

        $(':input').each(function() {
            let mapsTo = $(this).attr('auto-maps-value-to');

            if (mapsTo) {
                data[mapsTo] = $(this).val();
            }
        });

        return data;
    }

    function getBlank() {
        return {
            itemCode: null,
            neededQuantity: 1,
            onHandQuntity: 0,
            supplierId: null,
            supplierQuantity: 0,
            supplierUnitCost: 0
        };
    }

    return { init, setOnSaveListener, view, edit, create, close, getData };
})();