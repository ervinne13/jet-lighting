
<div class="row">
    <h3>
        Inquire Item Stocks: 
        <strong class="pull-right text-navy">{{ $inquiry->getDocumentNumber() }}</strong>
    </h3>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Purpose</label> 
            <textarea name="purpose" class="form-control">{{ $inquiry->getPurpose() }}</textarea>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Created By</label> 
            <h4 class="text-navy">{{ $inquiry->getCreatedBy()->getName() }}</h4>
        </div>
    </div>
</div>