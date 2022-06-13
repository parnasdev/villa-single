@props(['model1', 'model2', 'data' => []])
<div class="date-search flex-between w-100 position-relative" x-data="calender()">

    <div class="calender">

        <div class="body-calender">
            <div class="month">
                <div class="month-header">
                    <i class="icon-right-open" @click="changeMonth(-1)"></i>
                    <h3 class="name-month" x-text="months.find(x => x.id === month1).value"></h3>
                    &nbsp;
                    <span x-text="year1 + (year2 > year1 ? ' - ' + year2 : '')"></span>
                    &nbsp;
                    <h3 class="name-month" x-text="months.find(x => x.id === month2).value"></h3>
                    <i class="icon-left-open" @click="changeMonth(1)"></i>
                </div>
                <div class="month-body">
                    <div class="weeks">
                        <div class="parent-days-title w-100 flex-between">
                            <div class="top">
                                <span>ش</span>
                                <span>ی</span>
                                <span>د</span>
                                <span>س</span>
                                <span>چ</span>
                                <span>پ</span>
                                <span class="text-danger">ج</span>
                            </div>
                            <div class="top">
                                <span>ش</span>
                                <span>ی</span>
                                <span>د</span>
                                <span>س</span>
                                <span>چ</span>
                                <span>پ</span>
                                <span class="text-danger">ج</span>
                            </div>
                        </div>
                        <div class="parent-parent-body w-100 flex-between">
                            <div class="bottom">
                                <template x-for="(item , index) in calenderData">
                                    <template x-if="index < monthLength1">
                                        <span @click="selectDate(item)"

                                            :class="{
                                                'text-danger': item.isHoliday,
                                                'active-today': item.isToday,
                                                'before-day': item.status === 'disabled',
                                                'active-start': moment(item.valueEn, format).isSame(startDate),
                                                'active-end': moment(item.valueEn, format).isSame(endDate),
                                                'active-between': allDate.includes(item)
                                            }"
                                            x-html="getItemTitle(item)">
                                             <small class="tooltip">قبلا رزرو شده است</small>
                                        <small class="d-none"></small>
                                        </span>
                                      
                                    </template>
                                </template>
                            </div>
                            <div class="bottom">
                                <template x-for="(item , index) in calenderData">
                                    <template x-if="index >= monthLength2">
                                        <span @click="selectDate(item)"
                                            :class="{
                                                'text-danger': item.isHoliday,
                                                'active-today': item.isToday,
                                                'before-day': item.status === 'disabled',
                                                'active-start': moment(item.valueEn, format).isSame(startDate),
                                                'active-end': moment(item.valueEn, format).isSame(endDate),
                                                'active-between': allDate.includes(item)
                                            }"
                                            x-html="getItemTitle(item)">
                                        </span>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <style>

    </style>
@endpush

@push('scripts')
    <script>
        function calender() {
            return {
                month1: null,
                month2: null,
                year1: null,
                year2: null,
                minDate: '{{ $attributes['minDate'] ?? null }}',
                maxDate: '{{ $attributes['maxDate'] ?? null }}',
                separator: '/',
                format: null,
                jFormat: null,
                show: false,
                displayDate1: null,
                displayDate2: null,
                hour: null,
                min: null,
                months: [{
                        id: 1,
                        value: "فرودین"
                    },
                    {
                        id: 2,
                        value: "اردیبهشت"
                    },
                    {
                        id: 3,
                        value: "خرداد"
                    },
                    {
                        id: 4,
                        value: "تیر"
                    },
                    {
                        id: 5,
                        value: "مرداد"
                    },
                    {
                        id: 6,
                        value: "شهریور"
                    },
                    {
                        id: 7,
                        value: "مهر"
                    },
                    {
                        id: 8,
                        value: "آبان"
                    },
                    {
                        id: 9,
                        value: "آذر"
                    },
                    {
                        id: 10,
                        value: "دی"
                    },
                    {
                        id: 11,
                        value: "بهمن"
                    },
                    {
                        id: 12,
                        value: "اسفند"
                    },
                ],
                calenderData: [],
                startDate: @entangle($model1),
                endDate: @entangle($model2),
                monthLength1: 0,
                monthLength2: 0,
                allDate: [],
                reserves: @js($data),
                init() {
                    this.format = 'YYYY' + this.separator + 'M' + this.separator + 'D';

                    this.jFormat = 'jYYYY' + this.separator + 'jM' + this.separator + 'jD';

                    this.$watch('minDate', value => {
                        this.generateCalender();
                    })

                    this.$watch('startDate', value => {
                        this.displayDate1 = moment(value).format(this.jFormat);
                    })

                    this.$watch('endDate', value => {
                        this.displayDate2 = moment(value).format(this.jFormat);
                    })

                    if (this.startDate !== null) {
                        this.displayDate1 = moment(this.startDate).format(this.jFormat);
                        this.month1 = +moment(this.startDate).format('jM')
                        this.year1 = +moment(this.startDate).format('jYYYY')
                    } else {
                        this.displayDate1 = '';
                        this.month1 = +moment().format('jM')
                        this.year1 = +moment().format('jYYYY')
                    }

                    if (this.endDate !== null) {
                        this.displayDate2 = moment(this.endDate).format(this.jFormat);
                        this.month2 = +moment(this.endDate).add(1, 'M').format('jM');
                        this.year2 = +moment(this.endDate).format('jYYYY');
                    } else {
                        this.displayDate2 = '';
                        this.month2 = +moment().add(1, 'M').format('jM')
                        this.year2 = +moment().format('jYYYY')
                    }

                    this.generateCalender();

                    this.allDate = this.calenderData.filter(item => moment(item.valueEn, this.format).isBetween(this
                        .startDate, this.endDate))

                },
                changeMonth(num) {
                    this.month1 += num;

                    this.month2 += num;

                    if (this.month1 > 12) {
                        this.month1 = 1;
                        this.year1 += num
                    }

                    if (this.month2 > 12) {
                        this.month2 = 1;
                        this.year2 += num
                    }

                    if (this.month1 < 1) {
                        this.month1 = 12;
                        this.year1 += num
                    }

                    if (this.month2 < 1) {
                        this.month2 = 12;
                        this.year2 += num
                    }

                    this.generateCalender();
                },
                generateCalender() {
                    this.calenderData = []
                    let dates1 = [];
                    let dates2 = [];

                    for (let i = 1; i <= 31; i++) {
                        let date = this.year1 + this.separator + this.month1 + this.separator + i
                        dates1.push(date);
                    }

                    for (let i = 1; i <= 31; i++) {
                        let date = this.year2 + this.separator + this.month2 + this.separator + i
                        dates2.push(date);
                    }
                    let firstDate1 = dates1[0]

                    let firstDate2 = dates2[0]

                    switch (moment(firstDate1, this.jFormat).day()) {
                        case 0:
                            dates1.unshift(
                                '',
                            );
                            break;
                        case 1:
                            dates1.unshift(
                                '',
                                '',
                            );
                            break;
                        case 2:
                            dates1.unshift(
                                '',
                                '',
                                '',
                            );
                            break;
                        case 3:
                            dates1.unshift(
                                '',
                                '',
                                '',
                                '',
                            )
                            break;
                        case 4:
                            dates1.unshift(
                                '',
                                '',
                                '',
                                '',
                                '',
                            )
                            break;
                        case 5:
                            dates1.unshift(
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                            )
                            break;
                    }
                    switch (moment(firstDate2, this.jFormat).day()) {
                        case 0:
                            dates2.unshift(
                                '',
                            );
                            break;
                        case 1:
                            dates2.unshift(
                                '',
                                '',
                            );
                            break;
                        case 2:
                            dates2.unshift(
                                '',
                                '',
                                '',
                            );
                            break;
                        case 3:
                            dates2.unshift(
                                '',
                                '',
                                '',
                                '',
                            )
                            break;
                        case 4:
                            dates2.unshift(
                                '',
                                '',
                                '',
                                '',
                                '',
                            )
                            break;
                        case 5:
                            dates2.unshift(
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                            )
                            break;
                    }

                    for (let i = dates1.length; i < 42; i++) {
                        dates1.push('');
                    }

                    for (let i = dates2.length; i < 42; i++) {
                        dates2.push('');
                    }

                    dates1.forEach((item, index) => {
                        let status = 'active';

                        if (item !== '') {
                            if (moment(item, this.jFormat).format('jM') !== moment(this.year1 + this.separator +
                                    this.month1 + this.separator + 1, this.jFormat).format('jM')) {
                                status = 'hidden'
                            } else if ((this.minDate !== null || this.minDate !== '') && moment(item, this.jFormat)
                                .isBefore(moment(this.minDate, this.jFormat))) {
                                status = 'disabled'
                            } else if ((this.minDate !== null || this.maxDate !== '') && moment(item, this.jFormat)
                                .isAfter(moment(this.maxDate, this.jFormat))) {
                                status = 'disabled'
                            }
                        }

                        this.calenderData.push({
                            'value': item,
                            'valueEn': item !== '' ? moment(item, this.jFormat).format(this.format) : '',
                            'isToday': item !== '' ? moment(item, this.jFormat).isSame(moment(), 'day') :
                                false,
                            'isHoliday': item !== '' ? moment(item, this.jFormat).day() === 5 : false,
                            'status': item !== '' ? status : 'hidden'
                        })
                    });

                    dates2.forEach((item, index) => {
                        let status = 'active';

                        if (item !== '') {
                            if (moment(item, this.jFormat).format('jM') !== moment(this.year2 + this.separator +
                                    this.month2 + this.separator + 1, this.jFormat).format('jM')) {
                                status = 'hidden'
                            } else if ((this.minDate !== null || this.minDate !== '') && moment(item, this.jFormat)
                                .isBefore(moment(this.minDate, this.jFormat))) {
                                status = 'disabled'
                            } else if ((this.minDate !== null || this.maxDate !== '') && moment(item, this.jFormat)
                                .isAfter(moment(this.maxDate, this.jFormat))) {
                                status = 'disabled'
                            }
                        }
                        this.calenderData.push({
                            'value': item,
                            'valueEn': item !== '' ? moment(item, this.jFormat).format(this.format) : '',
                            'isToday': item !== '' ? moment(item, this.jFormat).isSame(moment(), 'day') :
                                false,
                            'isHoliday': item !== '' ? moment(item, this.jFormat).day() === 5 : false,
                            'status': item !== '' ? status : 'hidden'
                        })
                    });
                    this.monthLength1 = dates1.length;
                    this.monthLength2 = dates2.length;
                },
                getDay(date) {
                    return date.split(this.separator)[2]
                },
                getPrice(date) {
                    let result = '';
                    this.reserves.forEach(x => {
                        if (moment(date, this.jFormat).isSame(moment(x.date, 'jYYYY-jM-jD').format('YYYY-MM-DD'))) {
                            result = (x.items.price / 1000).toString();
                        }
                    })
                    return result
                },

                getItemTitle(item) {
                    let result = '';
                    if (item.status === 'hidden') {
                        result =  '';
                    } else if (item.status === 'disabled') {
                        return this.getDay(item.value);
                    } else {
                        if(this.getIsReserved(item.value)) {
                            result =  this.getDay(item.value);
                        }else {
                            result =  this.getDay(item.value) + '<br>' + this.getPrice(item.value);
                        }
                    }
                    return result;
                },
                getIsReserved(date) {
                    let result = '';
                    this.reserves.forEach(x => {
                        if (moment(date, this.jFormat).isSame(moment(x.date, 'jYYYY-jM-jD').format('YYYY-MM-DD'))) {
                            result = x.items.isReserved
                        }
                    })
                    return result
                },
                getItemIndex(date) {
                    return this.calenderData.findIndex(x => moment(x.valueEn, 'YYYY/M/D').isSame(moment(date,
                        'YYYY-MM-DD')));
                },
                selectDate(obj) {
                    if (!['disabled', 'hidden'].includes(obj.status)) {

                        if (this.getIsReserved(obj.value)) {
                            alert('این روز رزرو شده است');
                        } else {
                            if (this.startDate === null) {
                                this.startDate = moment(obj.valueEn).format('YYYY-MM-DD');
                                this.minDate = obj.value
                            } else if (this.endDate === null) {
                                if (moment(obj.valueEn, this.format).isSame(this.startDate)) {
                                    this.startDate = null
                                    this.minDate = moment().format(this.jFormat)
                                } else if (moment(obj.valueEn, this.format).isBefore(this.startDate)) {
                                    this.startDate = moment(obj.valueEn).format('YYYY-MM-DD')
                                    this.minDate = obj.value
                                } else {
                                    this.endDate = moment(obj.valueEn).format('YYYY-MM-DD')
                                    // this.allDate = this.calenderData.filter(item => moment(item.valueEn, this.format)
                                    //     .isBetween(
                                    //         this.startDate, this.endDate))
                                    for (let i = this.getItemIndex(this.startDate); i <= this.getItemIndex(this
                                            .endDate); i++) {
                                        if (!this.getIsReserved(this.calenderData[i].value)) {
                                            if (this.calenderData[i].status !== 'hidden') {
                                                this.allDate.push(this.calenderData[i])
                                            }
                                        } else {
                                            this.endDate = moment(this.calenderData[i].valueEn).format('YYYY-MM-DD')
                                            console.log(this.startDate)
                                            console.log(this.endDate)
                                            break
                                        }
                                    }
                                }
                            } else {
                                this.startDate = moment(obj.valueEn).format('YYYY-MM-DD');
                                this.endDate = null;
                                this.allDate = [];
                                this.minDate = obj.value;
                            }
                        }
                    }
                },
                isSelectedDay(date) {
                    return moment(date, this.jFormat).isSame(moment(this.inputData, this.jFormat), 'day')
                },
            }
        }
    </script>
@endpush
