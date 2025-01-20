<aside>
  <div class="sidebar_main_contents">
    <ul>
      @foreach($gradedColors as $grade)
        <form method="GET" action="{{ route('user.show.curriculum') }}">
            <button 
                    class="grade-button-{{$grade->color}}" id="grade-change-button-{{$grade->id}}" disabled>
                    {{ $grade->name }}
            </button>
        </form>
      @endforeach
    </ul>
  </div>
</aside>
