<script id="tmpl-detail-form" type="text/template">
    <div class="form-row row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Item <span class="selected-item-data-container text-navy" data-item-field="code" data-item-field-format=" (:code)"></span></label>
                <select class="form-control" name="item_code" triggers="item-selection" auto-maps-value-to="itemCode">
                    <option selected disabled>Select an Item</option>
                    @foreach($items as $item)
                    {% o.selectedItem = o.item && '{{ $item->getCode() }}' == o.item.code ? 'selected' : ''; %}
                    <option value="{{ $item->getCode() }}" {%= o.selectedItem %}>{{ $item->getName() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>On Hand Qty</label>
                <input 
                    auto-maps-value-to="onHandQuantity"
                    value="{%= o.onHandQuantity %}"                            
                    name="on_hand_quantity" 
                    type="text" class="form-control selected-item-data-field" 
                    data-item-field="onHandQty"                            
                    disabled>
            </div>

            <div class="form-group selected-item-data-visible" data-item-visible-if-exists="leastCostSupplier" hidden>
                <label>Supplier with Lowest Cost (Last PO)</label>
                <br>
                <strong 
                    class="text-navy selected-item-data-container" 
                    data-item-field="leastCostSupplierName"
                ></strong>
            </div>

            <div class="form-group selected-item-data-visible" data-item-visible-if-exists="leastCostSupplier" hidden>
                <label
                    class="selected-item-data-container" 
                    data-item-field="leastCostSupplierName"
                    data-item-field-format="Last :leastCostSupplierName PO price:">
                </label>
                <br>
                <strong 
                    class="text-navy selected-item-data-container" 
                    data-item-field="leastCostSupplierCost"
                    data-item-field-format="FORMAT:money">
                </strong>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label>Required Qty</label>
                <input auto-maps-value-to="neededQuantity" value="{%= o.neededQuantity %}" name="needed_quantity" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label>Inquired to Supplier</label>
                <select class="form-control" name="supplier_id">
                    <option selected>No Supplier</option>
                    @foreach($suppliers as $supplier)
                    {% o.selectedSupplier = o.supplier && '{{ $supplier->getId() }}' == o.supplier.id ? 'selected' : ''; %}
                    <option value="{{ $supplier->getId() }}" {%= o.selectedSupplier %}>{{ $supplier->getName() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Available Supplier Qty</label>
                <input auto-maps-value-to="supplierQuantity" value="{%= o.supplierQuantity %}" name="supplier_quantity" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label>Available Supplier Unit Cost</label>
                <input auto-maps-value-to="supplierUnitCost" value="{%= o.supplierUnitCost %}" name="supplier_unit_cost" type="text" class="form-control">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="pull-right">
                <button action="save-detail" class="btn btn-sm btn-primary detail-action">
                    Save Detail
                </button>

                <button action="close-detail" class="btn btn-sm btn-default detail-action">
                    Close Detail
                </button>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</script>