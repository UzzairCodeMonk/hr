<div  v-if="results.length !== 0">
<div v-for="notification in results">
    @csrf    
    <div class="media-list media-list-hover media-list-divided media-list-xs">
        <a class="media mark-read" v-on:click="redirect(notification.id,notification.data.url)">
            <span class="avatar"><i class=""></i></span>            
            <div class="media-body">
                <p>@{{notification.data.message}}</p>
                <time datetime="@{{notification.created_at}}">@{{notification.created_at}}</time>
            </div>
        </a>
    </div>
</div>
</div>
<div v-else>
        <a href="#">
            <div class="message-content">
                <h6 class="message-title">
                    Tiada notifikasi baru
                </h6>
            </div>
        </a>
    </div> 
<div class="dropdown-footer">
    <a href="{{route('notifications')}}" class="text-center">View all notifications</a>
</div>
