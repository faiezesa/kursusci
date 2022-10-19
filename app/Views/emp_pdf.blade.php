@if ($data['view']=='pdf')
    <h2>HTML Table</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>IC</th>
            <th>Email</th>
        </tr>
        @foreach($data['employee'] as $d)
            <tr>
                <td>{!! $d['name'] !!}</td>
                <td>{!! $d['icno'] !!}</td>
                <td>{!! $d['email'] !!}</td>
            </tr>
        @endforeach
    </table>
@endif