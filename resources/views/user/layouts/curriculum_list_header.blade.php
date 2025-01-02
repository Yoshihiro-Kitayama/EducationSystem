<div class="curriculum_header">

  <div class="curriculum_header_back">
    <a href="{{ route('show.top') }}">←戻る</a>
  </div>

  <div class="curriculum_header_contents">
    <!-- 前月ボタン -->
    <button class="curriculum_header_prev_button" id="curriculum_prev-button" data-route="{{ $prev_month_route }}" data-grade_id="{{ $grade_id }}">◀</button>

    <!-- 現在の年月表示 -->
    <div id="current_year_month">{{ $current_month->format('Y年m月') }}スケジュール</div>

    <!-- 次月ボタン -->
    <button class="curriculum_header_next_button" id="curriculum_next-button" data-route="{{ $next_month_route }}">▶</button>
    <!-- 学年表示 -->
    <div class="curriculum_header_grade_button-{{ $grade_color }}" id="curriculum_header_grade">{{ $grade_name }}</div>
  </div>

</div>