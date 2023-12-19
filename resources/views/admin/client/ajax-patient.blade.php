<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','client_table')->first()->custom_lang }} <button class="btn btn-success btn-sm" onclick="printReport()"><i class="fas fa-print    "></i></button></h6>
    </div>
    <div class="card-body" id="search-appointment">
        <div class="table-responsive printArea">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                        <th width="15%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                        <th width="10%">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                        <th width="10%">{{ $website_lang->where('lang_key','total_appointment')->first()->custom_lang }}</th>
                        <th width="15%">{{ $website_lang->where('lang_key','reg_date')->first()->custom_lang }}</th>
                        <th width="15%">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</th>
                        <th width="10%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $index => $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ ucfirst($item->name) }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->appointment->count() }}</td>
                        <td>{{ $item->created_at->format('m-d-Y') }}</td>


                        <td>
                            @if ($item->status==0)
                                    <span class="badge badge-danger">{{ $website_lang->where('lang_key','pending')->first()->custom_lang }}</span>
                                @else
                                <span class="badge badge-success">{{ $website_lang->where('lang_key','success')->first()->custom_lang }}</span>
                                @endif
                        </td>
                        <td>
                            <a  href="{{ route('admin.client.show',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
