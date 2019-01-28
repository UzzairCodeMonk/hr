<div class="card bg-lighter">
    <div class="card-header">
        <h3 class="card-title">Add Award Record</h3>
        <div class="card-options">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <!-- <a class="btn btn-sm btn-secondary text-dark" id="addrow"> Add Row </a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Name</label>
                    <input type="text" name="name" class="form-control" />
                    @include('backend.shared._errors',['entity'=>'name'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Received Date</label>
                    <input type="text" name="received_date" class="form-control received-date" />
                    @include('backend.shared._errors',['entity'=>'received_date'])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="" class="require">Notes</label>
                <textarea name="notes" id="" cols="30" rows="4" class="form-control"></textarea>
                @include('backend.shared._errors',['entity'=>'notes'])
            </div>
        </div>
    </div>
</div>
