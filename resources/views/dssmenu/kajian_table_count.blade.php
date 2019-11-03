<table id="table_count" class="table table-bordered">
              <thead class="thead-light text-center">
                <th class="th-index">No</th>
                <th>TAHUN</th>
                <th>KKCB 1</th>
                <th>KKCB 2</th>
                <th>KKCB 3</th>
                <th>PMTK</th>                  
              </thead>
              <tbody>
                @foreach($kajian as $key => $k)
                  <tr class="text-center">
                    <td>{{$key+=1}}</td>
                    <td>{{$k->tahun}}</td>
                    <td><a href="{{ route('kajian.show.count',['tahun' => $k->tahun, 'kategori' => 'kkcb1']) }}" title="Data Tahun {{$k->tahun}}" class="kajian_show">{{$k->kkcb1}}</a></td>
                    <td><a href="{{ route('kajian.show.count',['tahun' => $k->tahun, 'kategori' => 'kkcb2']) }}" title="Data Tahun {{$k->tahun}}" class="kajian_show">{{$k->kkcb2}}</a></td>
                    <td><a href="{{ route('kajian.show.count',['tahun' => $k->tahun, 'kategori' => 'kkcb3']) }}" title="Data Tahun {{$k->tahun}}" class="kajian_show">{{$k->kkcb3}}</a></td>
                    <td><a href="{{ route('kajian.show.count',['tahun' => $k->tahun, 'kategori' => 'pmtk']) }}" title="Data Tahun {{$k->tahun}}" class="kajian_show">{{$k->pmtk}}</a></td>
                  </tr>
                @endforeach

              </tbody>
            </table>