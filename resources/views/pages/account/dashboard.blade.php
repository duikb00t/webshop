@extends('layouts.account')

@section('account.title')
    <h2 class="text-center block-title">
        {{ trans('titles.account.dashboard', ['company' => $customer->getCompany()->getName()]) }}
    </h2>
@endsection

@section('account.content')
    <table class="table">
        <tr>
            <td><b>Klantnummer</b></td>
            <td>{{ $customer->getCompany()->getCustomerNumber() }}</td>
        </tr>
        <tr>
            <td><b>Bedrijf</b></td>
            <td>{{ $customer->getCompany()->getName() }}</td>
        </tr>
        <tr>
            <td><b>Correspondentie adres</b></td>
            <td>{{ $customer->getEmail() }}</td>
        </tr>
        <tr>
            <td><b>Aantal bestellingen</b></td>
            <td>{{ $orderCount ?? 0 }}</td>
        </tr>
    </table>
@endsection