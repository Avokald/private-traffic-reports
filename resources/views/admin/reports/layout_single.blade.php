<div class="content content-narrow">
    <div class="block">
        <div class="block-content">
            <form method="post" action="{{
                            $report->id
                                ? route('admin.report.update', $report->id)
                                : route('admin.report.store') }}">
                @csrf
                @if ( $report->id )
                    @method('patch')
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Основные</h3>
                    </div>

                    <div class="card-content">

                        <div class="form-group col-sm-12">
                            <div class="form-material push-20">
                                <input class="form-control"
                                       type="text"
                                       name="title"
                                       value="{{ $report->title }}"
                                       required
                               >
                                <label>Заголовок</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Описание</h3>
                    </div>
                    <div class="card-content card-content-full">
                        <textarea class="form-control" name="excerpt">{{
                            $report->description
                        }}</textarea>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <button>Сохранить</button>
                        <a href="{{ route('admin.report.index') }}" class="btn btn-link">Отменить</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>