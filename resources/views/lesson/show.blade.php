<h1>{{ $lesson->name }}</h1>
<div>
    <!-- vacancyLevelアクセサが呼ばれ、VacancyLevelクラスのmark()を実行 -->
    <span>空き状況: {{ $lesson->vacancyLevel->mark() }}</span>
</div>
