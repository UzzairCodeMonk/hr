<div class="modal fade" id="add-award-records" tabindex="-1" role="dialog" aria-labelledby="add-award-records"
    aria-hidden="true">
    <form action="{{route('award.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Award Record(s)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="myTable" class="table table-bordered dynamic-list w-20">
                        <thead>
                            @include('profile::partials.awards.table-header')
                        </thead>
                        <tbody>
                            @include('profile::partials.awards.input')
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
