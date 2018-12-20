<div class="modal fade" id="add-experience-records" tabindex="-1" role="dialog" aria-labelledby="add-family-records"
    aria-hidden="true">
    <form action="{{route('experience.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Employment History Records</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="myTable" class="table table-bordered dynamic-list w-20">
                        <thead>
                            @include('profile::partials.experience.table-header')
                        </thead>
                        <tbody>
                            @include('profile::partials.experience.input')
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
