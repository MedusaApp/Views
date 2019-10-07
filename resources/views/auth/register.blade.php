@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ config('medusa.registration_title')  }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <label for="first_name">{{__('First Name')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend align-middle">
                                        <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                    </div>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name" autofocus tabindex="1">
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="middle_name" class="text-md-left">{{__('Middle Name')}}</label>
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="additional-name" autofocus tabindex="2">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="last_name" class="text-md-left">{{__('Last Name')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend align-middle">
                                        <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                    </div>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" autofocus tabindex="3">
                                </div>
                            </div>
                            <div class="col-md-1 form-group">
                                <label for="suffix" class="text-md-left">{{__('Suffix')}}</label>
                                {!! Form::select('suffix', ['' => 'None', 'Jr' => 'Jr', 'Sr' => 'Sr', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', 'V' => 'V'], "{{ old('suffix') }}", ['class' => 'form-control', 'tabindex' => "4"]) !!}
                            </div>
                        </div>
                        <div class="row">
                            @error('first_name')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            @error('middle_name')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            @error('last_name')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="address_1">{{ __('Address') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="address_1" type="text" class="form-control @error('address_1') is-invalid @enderror" name="address_1" value="{{ old('address_1') }}" required autocomplete="address-line1" tabindex="5">
                                        </div>

                                        @error('address_1')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="telephone" class="text-md-left">{{__('Telephone')}}</label>
                                        <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="tel" autofocus tabindex="11">
                                        @error('telephone')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="address_2">{{ __('Address Line 2') }}</label>
                                        <input id="address_2" type="text" class="form-control" name="address_2" value="{{ old('address_2') }}" autocomplete="address-line2" tabindex="6">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dob" class="text-md-left">{{__('Date of Birth')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="bday" autofocus tabindex="12">
                                        </div>
                                        @error('dob')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="country">{{__('Country')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <select class="form-control @error('country') is-invalid @enderror" id="country" name="country" required tabindex="7">
                                                <option value="">{{__('Select a country')}}</option>
                                                @foreach(\PragmaRX\Countries\Package\Countries::all()->pluck('name.common', 'cca3') as $cca3 => $cname)
                                                    <option value="{{ $cca3 }}" @if($cca3 === old('country')) selected @endif>{{ $cname }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('country')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" tabindex="13">
                                        </div>

                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="state_province" class="text-md-left">{{__('State/Province')}}</label>

                                            <select class="form-control @error('state_province') is-invalid @enderror" id="state_province" name="state_province" tabindex="8">
                                                <option value="">{{__('Start typing to find or add your state/province')}}</option>
                                            </select>

                                        @error('state_province')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="password" type="password" class="show-hide form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" tabindex="14">
                                            <div class="input-group-append show-hide">
                                                <span class="input-group-text"><span class="fas fa-eye-slash" aria-hidden="true"></span></span>
                                            </div>
                                        </div>

                                        @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="city" class="text-md-left">{{__('City')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="address-level2" autofocus tabindex="9">
                                        </div>
                                        @error('city')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" tabindex="15">
                                            <div class="input-group-append show-hide">
                                                <span class="input-group-text"><span class="fas fa-eye-slash" aria-hidden="true"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="postal_code" class="text-md-left">{{__('Postal Code')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend align-middle">
                                                <span class="input-group-text fas fa-lg fa-asterisk text-info"></span>
                                            </div>
                                            <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code" autofocus tabindex="10">
                                        </div>
                                    @error('postal_code')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-12 text-md-center">
                                <button type="submit" class="btn btn-primary" tabindex="16">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="fas fa-lg fa-asterisk text-info"></span> Required
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function(){
            var xhr;
            var select_state, $select_state;
            var select_country, $select_country;

            $select_country = $('#country').selectize({
                render: {
                    option: function(data, escape) {
                        return '<div class="option"><span class="flag-icon flag-icon-' + String(escape(data.value)).toLowerCase() + '"></span> ' + escape(data.text) + '</div>';
                    },
                    item: function(data, escape) {
                        return '<div class="item"><span class="flag-icon flag-icon-' + String(escape(data.value)).toLowerCase() + '"></span> ' + escape(data.text) + '</div>';
                    }
                },
                onChange: function(value) {
                    select_state.disable();
                    select_state.clearOptions();
                    select_state.load(function(callback) {
                        xhr && xhr.abort();
                        xhr = getStates(value, callback);
                    });
                }
            });

            $select_state = $('#state_province').selectize({
                valueField: 'name',
                labelField: 'name',
                searchField: ['name'],
                create: true
            });
            select_country  = $select_country[0].selectize;
            select_state = $select_state[0].selectize;
            select_state.disable();

            var oldState = "{{ old('state_province', '') }}";

            if ($.trim(oldState).length) {
                select_state.clearOptions();
                select_state.load(function(callback) {
                    xhr && xhr.abort();
                    xhr = getStates(select_country.getValue(), callback);
                });
            }

            function getStates(country, callback) {
                return $.ajax({
                    url: '/api/v1/states/' + country,
                    success: function(results) {
                        select_state.settings.placeholder = "Start typing to find or add your state/province";
                        select_state.updatePlaceholder()
                        callback(results);
                        select_state.enable();
                        var oldState = "{{ old('state_province', '') }}";
                        if ($.trim(oldState).length) {
                            select_state.setValue(oldState);
                        }
                    },
                    error: function() {
                        callback();
                    }
                })
            };

            $(".show-hide").on('click', function(event) {
                event.preventDefault();
                if($( this ).prev().attr("type") === "text"){
                    $( this).prev().attr('type', 'password');
                    $( this ).find(".fas").addClass( "fa-eye-slash" );
                    $( this ).find(".fas").removeClass( "fa-eye" );
                }else if($( this ).prev().attr("type") === "password"){
                    $( this).prev().attr('type', 'text');
                    $( this ).find(".fas").removeClass( "fa-eye-slash" );
                    $( this ).find(".fas").addClass( "fa-eye" );
                }
            });
        });
    </script>
@endpush
