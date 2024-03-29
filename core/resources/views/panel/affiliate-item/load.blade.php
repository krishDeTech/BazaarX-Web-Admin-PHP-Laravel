<div class="card-body">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"
                        {{ $affiliate_items->perPage() == 10 ? 'selected' : '' }}>
                        10</option>
                    <option value="25"
                        {{ $affiliate_items->perPage() == 25 ? 'selected' : '' }}>
                        25</option>
                    <option value="50"
                        {{ $affiliate_items->perPage() == 50 ? 'selected' : '' }}>
                        50</option>
                    <option value="100"
                        {{ $affiliate_items->perPage() == 100 ? 'selected' : '' }}>
                        100</option>
                </select>
                entries
            </label>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search"
            value="{{ request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th class="no-export">Actions</th>
                    <th class="text-center no-export"># <div class="table-div"></div>
                    </th>

                    <th class="col_1">
                        User Name <div class="table-div"></div>
                    </th>
                    <th class="col_2">
                        Service <div class="table-div"></div>
                    </th>
                    <th class="col_3">
                        Service Amt <div class="table-div"></div>
                    </th>
                    <th class="col_3">
                        Amount <div class="table-div"></div>
                    </th>
                    <th class="col_7">
                        Created At <div class="table-div"></div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($affiliate_items->count() > 0)
                    @foreach($affiliate_items as  $affiliate_item)
                        <tr>
                            <td class="no-export">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i
                                            class="ik ik-chevron-right"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <a href="{{ @$affiliate_item->link ?? '#' }}"
                                            title="Edit Requirement" class="dropdown-item " target="_blank">
                                            <li class="p-0">Preview</li>
                                        </a>
                                    </ul>
                                </div>
                            </td>
                            {{-- @dd($requirement); --}}
                            <td class="text-center no-export"> {{ $loop->iteration }}</td>
                            <td class="col_1">{{ @$affiliate_item->user->name ?? 'Unknown' }}</td>
                            <td class="col_2">
                                {{ @$affiliate_item->service->title ?? '' }}
                            </td>
                            <td class="col_3">
                                {{ format_price($affiliate_item->service->price) ?? '' }}
                            </td>
                            <td class="col_3">
                                {{ format_price($affiliate_item->amount) }}
                            </td>
                            <td class="col_4">
                                {{$affiliate_item->created_at}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="8">No Data Found...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $affiliate_items->appends(request()->except('page'))->links() }}
    </div>
    <div>
       @if($affiliate_items->lastPage() > 1)
            <label for="">Jump To: 
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                    @for ($i = 1; $i <= $affiliate_items->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $affiliate_items->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </label>
       @endif
    </div>
</div>
