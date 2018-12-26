
let ItemSelection = (function() {

    let itemMap = {};
    let attachToSelector;
    let listenerSelector = '';

    function init(itemsRef, attachToSelectorRef) {
        itemsRef.forEach(item => {
            itemMap[item.code] = item;
        });

        attachToSelector = attachToSelectorRef == undefined ? '' : attachToSelectorRef;
        if (attachToSelector) {
            listenerSelector = `[for=${attachToSelector}]`;
        }
        
        initEvents();
    }

    function initEvents() {
        $(document).on('change', attachToSelector + '[triggers=item-selection]', function() {
            let code = $(this).val();
            let item = itemMap[code];
            loadItemDataToContainers(item);
            loadItemDataToFields(item);
            showItemDependentElements(item);
        });
    }

    function getItemByCode(code) {
        return itemMap[code];
    }

    function loadItemDataToContainers(item) {
        $('.selected-item-data-container' + listenerSelector).each(function() {
            let field = $(this).data('item-field');
            let format = $(this).data('item-field-format');
            if (field) {
                $(this).html(formatItemField(item, field, format));
            }
        });
    }

    function loadItemDataToFields(item) {        
        $('.selected-item-data-field' + listenerSelector).each(function() {
            let field = $(this).data('item-field');
            if (field) {
                $(this).val(getTranslatedFieldValue(item, field));
            }
        });
    }

    function showItemDependentElements(item) {
        $('.selected-item-data-visible' + listenerSelector).each(function() {
            let field = $(this).data('item-visible-if-exists');
            if (field && item[field]) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }    

    function formatItemField(item, field, format) {
        if (format) {
            let value = getTranslatedFieldValue(item, field);
            if (!value) {
                return '';
            }

            if (format === 'FORMAT:money') {
                return 'P ' + formatMoney(value);
            }

            return format.replace(`:${field}`, getTranslatedFieldValue(item, field));
        }
        
        return getTranslatedFieldValue(item, field);
    }

    /**
     * Taken from: https://stackoverflow.com/questions/149055/how-can-i-format-numbers-as-dollars-currency-string-in-javascript
     */
    function formatMoney(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
          d = d == undefined ? "." : d,
          t = t == undefined ? "," : t,
          s = n < 0 ? "-" : "",
          i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
          j = (j = i.length) > 3 ? j % 3 : 0;
      
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
      };

    function getTranslatedFieldValue(item, field) {
        if (field === 'leastCostSupplierName' && item.leastCostSupplier) {
            return item.leastCostSupplier.supplier.name;
        }

        if (field === 'leastCostSupplierCost' && item.leastCostSupplier) {
            return item.leastCostSupplier.unitCost;
        }

        return item[field];
    }

    return { init, getItemByCode };
})();