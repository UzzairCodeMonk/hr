<div class="modal fade" id="add-skill-records" tabindex="-1" role="dialog" aria-labelledby="add-skill-records"
    aria-hidden="true">
    <form action="{{route('skill.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Skill(s)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="myTable" class="table table-bordered dynamic-list w-20">
                        <thead>
                            @include('profile::partials.skills.table-header')
                        </thead>
                        <tbody>
                            @include('profile::partials.skills.input')
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
