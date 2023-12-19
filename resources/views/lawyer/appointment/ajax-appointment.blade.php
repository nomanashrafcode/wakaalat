@if ($appointments->count()!=0)
<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                <th width="15%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                <th width="15%">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                <th width="15%">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                <th width="15%">{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                <th width="25%">{{ $website_lang->where('lang_key','time')->first()->custom_lang }}</th>
                <th width="5%">{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</th>
                <th width="10%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $index => $item)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ ucfirst($item->user->name) }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->user->phone }}</td>
                <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                <td>
                    @if ($item->payment_status==0)
                            <span class="badge badge-danger">{{ $website_lang->where('lang_key','pending')->first()->custom_lang }}</span>
                        @else
                        <span class="badge badge-success">{{ $website_lang->where('lang_key','success')->first()->custom_lang }}</span>
                        @endif
                </td>
                <td>
                    <a href="{{ route('lawyer.meet',$item->id) }}"  class="btn btn-primary btn-sm">{{ $website_lang->where('lang_key','meet')->first()->custom_lang }}</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@else
    <h3 class="text-danger text-center">{{ $website_lang->where('lang_key','app_not_found')->first()->custom_lang }}</h3>
@endif
