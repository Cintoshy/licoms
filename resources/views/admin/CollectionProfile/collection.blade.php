@extends('layout.layout')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Collection Profile</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-active table-striped text-center" id="collection" width="100%" cellspacing="0">
                <thead class="bg-gradient-info text-light">
                    <tr>
                        <th colspan="2">CCS</th>
                        <th colspan="2">2024</th>
                        <th colspan="2">2023</th>
                        <th colspan="2">2022</th>
                        <th colspan="2">2021</th>
                        <th colspan="2">2020</th>
                        <th rowspan="2">Printed Books</th>
                        <th rowspan="2">Electronics Books</th>
                        <th colspan="2">Grand Total</th>
                        <th rowspan="2"> % per Subject</th>
                        <th rowspan="2"> Titles Needed</th>
                        <th colspan="2">2019 Below</th>
                    </tr>
                <tr style="font: 20px;">
                        <th>CC</th>
                        <th>Courses</th>
                        <th>T</th>
                        <th>V</th>
                        <th>T</th>
                        <th>V</th>
                        <th>T</th>
                        <th>V</th>
                        <th>T</th>
                        <th>V</th>
                        <th>T</th>
                        <th>V</th>
                        <th>T</th>
                        <th>V</th>
                        <th>T</th>
                        <th>V</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>B7HT1</td>
                        <td>Ethical Hacking 2</td>              
                        <td>3</td>
                        <td>2</td>
                        <td>5</td>
                        <td>5</td> 
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>5</td>
                        <td>4</td>
                        <td>5</td>
                        <td>5</td>
                        <td>2</td>
                        <td>5</td>
                        <td>3</td>
                        <td>80%</td>
                        <td>4</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                                        
                    <td>VY6O</td>
                        <td>Programming 2</td>
                        <td>4</td>
                        <td>3</td>
                        <td>1</td>
                        <td>4</td>
                        <td>5</td>
                        <td>3</td>
                        <td>2</td>
                        <td>5</td>
                        <td>5</td>
                        <td>3</td>
                        <td>1</td>
                        <td>4</td>
                        <td>6</td>
                        <td>3</td>
                        <td>68%</td>
                        <td>7</td>
                        <td>3</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
                    </div>
                </div>
            </div>
@endsection
