<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
	<script src="https://test17.salesdoc.io/js/axios.min.js"></script>
	<meta charset="UTF-8">
	<link rel="icon" href="../assets/logo.png">
	<title>Big report | Sales Doctor</title>
	<style scoped>
		.online_text {
			background: chartreuse;
			padding: 5px;
			border-radius: 10px;
			color: black;
		}
		.dot {
			height: 15px;
			width: 15px;
			background-color: red;
			border-radius: 50%;
			display: inline-block;
		}
		.cl-red {
		background-color: #b0160c;
		font-size: 10px !important;
		color: white;
		}
		.cl-warn-red {
			background-color: #EF7C24;
			font-size: 10px !important;
			color: white;
		}
		.v-data-table>.v-data-table__wrapper>table>thead>tr>th {
			padding: 0 12px;
		}
		.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
		}

		.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
		}

		.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
		}

		.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
		}

		input:checked + .slider {
		background-color: #2196F3;
		}

		input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
		border-radius: 34px;
		}

		.slider.round:before {
		border-radius: 50%;
		}
		.date_ymd{
			font-size: 10px;
			background-color: grey;
			color: white;
			border-radius: 20px;
			padding: 3px;
		}
		.date_none{
			display: none;
		}
	</style>
</head>
<body>
	
<div id="app">
<template>
  <v-container fluid class="grey lighten-5 mt-3">
    <v-row>
    	<v-col>
    		<div class="float-right">
          <input class="form-control" type="date" id="start_date" name="start_date" style="display: inline;width: auto;">
            <input class="form-control" type="date" id="get_date" name="get_date" style="display: inline;width: auto;">
            <button class="mb-1 btn btn-primary text-white" :loading="loading" type="button" @click="filter()">Поиск</button>
          </div>
          <div class="float-left">
            <!-- <div class="d-inline-block">
              <v-row>
                <v-col>
                  <button style="border-radius: 4px; padding: 8px; border: 1px solid white; background-color: #28a745; color: white;" onclick="tableToExcel('exportTable2','excel','excel')">EXCEL</button>
                      <a id="dlink"  href="" style="display: none"></a>
                </v-col>
              </v-row>
          </div> -->
		   	</div>
    	</v-col>
	  </v-row>

    <template>
      <div class="text-center">
        <v-overlay :value="loading">
          <div class="text-center">
          <v-progress-circular
            :size="50"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </div>  
        </v-overlay>
      </div>
    </template>
    <v-row class="mb-6 mt-4" no-gutters>
      <v-col cols="12">
        <v-simple-table>
          <template v-slot:default>
          <thead style="border: solid 1px grey;">
            <tr>
              <th class="text-left" width="220px">Имя</th>
              <th class="text-left">Workly</th>
              <th class="text-left">Перс. пропущ. звон</th>
              <th class="text-left">Пропущенные</th>
              <th class="text-left">Вход. звон</th>
              <th class="text-left">Total feedback %</th>
              <th class="text-left">Feedback 👍 %</th>
              <th class="text-left">Like</th>
              <th class="text-left">Punishment</th>
              <th class="text-left">Незарег. вход. клиенты</th>
              <th class="text-left">Script</th>
              <th class="text-left">Product</th>
              <th class="text-left">👍</th>
              <th class="text-left">☹️</th>
              <th class="text-left" width="160px"><span>онлайн-время</span></th>
            </tr>
          </thead>
          <tbody style="border: solid 1px grey;">
            <tr v-for="report in users_5995">
              <td>{{ report.name }}</td>
              <td>workly</td>
              <td>{{ oper_misseds[report.num] ?? 0 }}</td>
              <td>{{ bigDataPeriod.missed }}</td>
              <td>{{ report.vxod_count }}</td>
              <td>{{ report.vxod_count > 0 ? ( ((parseFloat(feedbacks.mark3[report.num] ?? 0) + parseFloat(feedbacks.mark0[report.num] ?? 0))/report.vxod_count) * 100 ).toFixed(1) : 0 }} %</td>
              <td>{{ report.vxod_count > 0 ? ( (parseFloat(feedbacks.mark3[report.num] ?? 0)/report.vxod_count) * 100 ).toFixed(1) : 0 }} %</td>
              <td>{{ extra.likes[report.num] ? extra.likes[report.num].likes : 0 }}</td>
              <td>{{ extra.likes[report.num] ? extra.likes[report.num].punishments : 0 }}</td>
              <td>{{ unknownClients.inbound[report.num] ? unknownClients.inbound[report.num] : 0 }}</td>
              <td>{{ extra.products[report.num] ? parseFloat(parseFloat(extra.products[report.num].avg_script).toFixed(1)) : 0 }}</td>
              <td>{{ extra.products[report.num] ? parseFloat(parseFloat(extra.products[report.num].avg_product).toFixed(1)) : 0 }}</td>
              <td>{{ feedbacks.mark3[report.num] ?? 0 }}</td>
              <td>{{ feedbacks.mark0[report.num] ?? 0 }}</td>
              <td><span v-show="oper_times[report.num] > 0">{{ calcHMS(oper_times[report.num], '1') }}</span></td>
            </tr>
          </tbody>
          </template>
        </v-simple-table>
      </v-col>

		  <!-- export excel -->
      <v-col style="display: none">
        <v-simple-table style="border-top: solid 1px grey;" id="exportTable2">
          <template v-slot:default>
            <thead style="border: solid 1px grey;">
              <tr>
                <th class="text-left" width="220px">Имя</th>
                <th class="text-left" width="160px"><span class="online_text">онлайн-время</span></th>
                <th class="text-left" width="15px">Вход. звон</th>
                <th class="text-left">Время</th>
                <th class="text-left" width="15px">Исход. звон</th>
                <th class="text-left">Время</th>
                <th class="text-left">Общ. вре.</th>
                <th class="text-left">%</th>
                <th class="text-left">👍</th>
                <th class="text-left">☹️</th>
                <th class="text-left">❌</th>
                <th class="text-left">от</th>
                <th class="text-left">до</th>
                <th class="text-left">Входящие</th>
                <th class="text-left">Пропущенные</th>
                <th class="text-left">Незарег. вход. клиенты</th>
                <th class="text-left">Незарег. исход. клиенты</th>
              </tr>
            </thead>
            <tbody style="border: solid 1px grey;">
              <tr v-for="report in users_5995">
                <td>{{report.name}}</td>
                <td><span class="online_text">{{ oper_times[report.num] }}</span></td>
                <td>{{report.vxod_count}}</td>
                <td>{{report.vxod_time}}</td>
                <td>{{report.isxod_count}}</td>
                <td>{{report.isxod_time}}</td>
                <td>{{report.all_time}}</td>
                <td>{{((report.all_time_s/(inSumTalk_5995+outSumTalk_5995))*100).toFixed(2)}}</td>
                <td>{{ feedbacks.mark3[report.num] ?? 0 }}</td>
                <td>{{ feedbacks.mark0[report.num] ?? 0 }}</td>
                <td>{{ oper_misseds[report.num] ?? 0 }}</td>
                <td>{{ from_date }}</td>
                <td>{{ to_date }}</td>
                <td>{{ bigDataPeriod.answered+bigDataPeriod.missed }}</td>
                <td>{{ bigDataPeriod.missed }}</td>
                <td>{{ unknownClients.inbound[report.num] ? unknownClients.inbound[report.num] : 0 }}</td>
                <td>{{ unknownClients.outbound[report.num] ? unknownClients.outbound[report.num] : 0 }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
      <!-- ------------ -->
    </v-row>
    <v-row>
      <v-col cols="11"></v-col>
      <v-col cols="1">
        <a href="/logout" class="mb-2 btn btn-outline-dark float-right">Выйти</a>
      </v-col>
    </v-row>
  </v-container>
</template>
	
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script>

	var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,';
    var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>';
    var base64 = function (s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    };
    var format = function (s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
        })
    };
    return function (table, name) {
        if (!table.nodeType) table = document.getElementById(table);
        var ctx = {worksheet: 'Monitoring' || 'Worksheet', table: table.innerHTML};
        document.getElementById("dlink").href = uri + base64(format(template, ctx));
        var filename = new Date().toLocaleDateString("en-GB");
        document.getElementById("dlink").download = 'Monitoring (' + filename + ')';
        document.getElementById("dlink").click();
    }
  })();

	new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data: {
      loading: false,
      today: new Date(),
      interval:null,
      calls: [],
      users: [],
      inbounds_5995: [],
      inTalk_5995: [], 
      inSumTalk_5995: null,
      inGetProg_5995: null,
      outbounds_5995: [],
      outTalk_5995: [],
      outSumTalk_5995:null,
      outGetProg_5995: null,
      inreports_5995: [],
      outreports_5995: [],
      real_reports_5995: [],
      fifos: [],
      users_5995: [],
      notTalk_5995: [],
      notAnswer_5995: [],
      feedbacks: {
        mark0: {},
        mark3: {}
      },
      bigData: [],
      bigDataPeriod: [],
      todayData: {},
      weekData: {},
      monthData: {},
      out_todayData: {},
      out_weekData: {},
      out_monthData: {},
      oper_times: {},
      availableOperators: [],
      oper_misseds: {},
      from_date: "",
      to_date: "",
      unknownClients: {
        inbound: {},
        outbound: {}
      },
      extra: {
        likes: {},
        products: {}
      }
    },
    async mounted () {
      var day = ("0" + this.today.getDate()).slice(-2);
      var month = ("0" + (this.today.getMonth() + 1)).slice(-2);
      var today = this.today.getFullYear()+"-"+(month)+"-"+(day);

      this.from_date = today
      this.to_date = today

      $('#get_date').val(today);
      $('#start_date').val(today);

      await this.get_date();

      this.loading = true; 

      await this.getUsers();
      await this.get_users_feedbacks();
      await this.getOperatorTime();
      this.getInfos_5995();
      this.getReport_5995();
      await this.getFifo();
      await this.fifoToReport();
      await this.getBigDataPeriod();

      this.loading = false;
    },
    created(){	

      this.interval = setInterval(() =>{
        this.get_date()},30000)

      this.interval = setInterval(() =>{
        this.get_users_feedbacks()},600000)

      this.interval = setInterval(() =>{
        this.getOperatorTime()},30000)

      this.interval = setInterval(() =>{
        this.getInfos_5995()},30000)

      this.interval = setInterval(() =>{
        this.getReport_5995()},30000)

      this.interval = setInterval(() =>{
        this.fifoToReport()},30000)

    },
    destroyed(){
      clearInterval(this.interval)
    },
    methods: {
      async getExtra(){
        await axios.get('bigreport/extra', {params: {from: $('#start_date').val(), to: $('#get_date').val()}}).then(response => {
          if (response.status == 200) {
            if (response.data.likes.length > 0) {
              for (const like of response.data.likes) {
                this.extra.likes[like.operator] = like
              }
              for (const product of response.data.products) {
                this.extra.products[product.operator] = product
              }
            }            
          }
        });	
      }, 
      async personalMissed(){	
        await axios.get('monitoring/personalMissed', {params: {date: this.today.toISOString().split('T')[0]}}).then(response => {
          if (response.status == 200) {	
            this.oper_misseds = []		
            for (const res of response.data) {
              var create = new Date(res.create_timestamp);
              var destroy = new Date(res.destroy_timestamp);
              if ( 
                this.availableOperators.includes(res.destination_number) && 
                !this.availableOperators.includes(res.caller_number) && 
                res.caller_number.search(".onpbx.ru") < 0 && 
                Math.abs(destroy - create) > 4000
              ) {		
                if (!this.oper_misseds[res.destination_number]) {
                  this.oper_misseds[res.destination_number] = 0;
                }
                this.oper_misseds[res.destination_number] += 1;								
              }
            }			
          }
        });									
      },
      async getOperatorTime(){
        await axios.get('monitoring/operatorTime', {params: {from: $('#start_date').val(), to: $('#get_date').val()}}).then(response => {
          if (response.status == 200) {
            this.oper_times = response.data.oper_times			
          }
        });	
      }, 
      async getUnknownClients(){
        await axios.get('monitoring/unknownClients', {params: {from: $('#start_date').val(), to: $('#get_date').val()}}).then(response => {
          if (response.status == 200) {
            for (const datum of response.data) {
              if (datum.direction == 'inbound') {
                if (!this.unknownClients.inbound[datum.operator]) {
                  this.unknownClients.inbound[datum.operator] = 0
                }
                this.unknownClients.inbound[datum.operator] = datum.count
              }else{
                if (!this.unknownClients.outbound[datum.operator]) {
                  this.unknownClients.outbound[datum.operator] = 0
                }
                this.unknownClients.outbound[datum.operator] = datum.count
              }
              
            }
          }
        });	
      }, 
      async filter(){
        this.from_date = $('#start_date').val()
        this.to_date = $('#get_date').val()
        
        await this.get_date();

        this.loading = true;

        await this.get_users_feedbacks();
        await this.getOperatorTime();
        this.getInfos_5995();
        this.getReport_5995();
        this.fifoToReport();
        await this.getBigDataPeriod();

        this.loading = false;
      },
      async getBigDataPeriod(){
        await axios.get('monitoring/bigData', {params: {from: $('#start_date').val(), to: $('#get_date').val()}}).then(response => {
          if (response.status == 200) {
            this.bigDataPeriod = {
              answered: 0,
              missed: 0,
              missed_in: 0,
              talking_time: 0
            }

            for (const datum of response.data) {
              if (datum.accountcode == 'inbound') {

                this.bigDataPeriod.talking_time += datum.user_talk_time
                if (datum.user_talk_time > 0) {
                  this.bigDataPeriod.answered += 1;
                }else{
                  this.bigDataPeriod.missed += 1;
                  this.bigDataPeriod.missed_in += this.checkDateHours(datum.start_stamp)
                }

              }
            }
          }
        });	
      },
      checkDateHours(timestamp){
        let date = new Date(timestamp * 1000),
          hours = date.getHours();
        if (hours >= 9 && hours <= 20) {
          return 1
        }else{
          return 0
        }
      },
      async get_users_feedbacks(){
        this.feedbacks = {
          mark0: {},
          mark3: {}
        }
        await axios.get('monitoring/usersFeedbacks', {params: {from: $('#start_date').val(), to: $('#get_date').val()}}).then(response => {
          if (response.status == 200) {
            for (const datum of response.data) {
              if (!this.feedbacks.mark0[datum.phone]) {
                this.feedbacks.mark0[datum.phone] = datum.mark0
              }
              if (!this.feedbacks.mark3[datum.phone]) {
                this.feedbacks.mark3[datum.phone] = datum.mark3
              }
            }
          }
        });		
      },
      async getUsers(){
        await axios.get('monitoring/users').then(response => {
          if (response.status == 200) {
            this.users = response.data
          }
        });
      },
      getInfos_5995: function(){
        let calls = this.calls;

        // -------------------------------- inbounds_5995 -----------------------------------------
        let inbounds_5995 = [];
        let inreports_5995 = [];
        for (var j = 0; j < calls.length; j++) {
          if (calls[j].gateway == '712075995' && calls[j].accountcode == 'inbound') {
            inbounds_5995.push(calls[j]);
            let infos = { 
              num: calls[j].destination_number,
              vxod_time: calls[j].user_talk_time
            }
            inreports_5995.push(infos);
          }
        }
        this.inbounds_5995 = inbounds_5995;

        // ===========================================================

        const resultArr = [];

        const groupByNum = inreports_5995.reduce((group, item) => {
          const { num } = item;
          group[num] = group[num] ?? [];
          group[num].push(item.vxod_time);
          return group;
        }, {});

        Object.keys(groupByNum).forEach((num) => {
          let counter = groupByNum[num].length;
          groupByNum[num] = groupByNum[num].reduce((a, b) => a + b);
          resultArr.push({
            'num': num,
            'vxod_time': groupByNum[num],
            'for_all_time': groupByNum[num],
            'vxod_count': counter
          })
        })
        this.inreports_5995 = resultArr;
        
        // ===========================================================

        let countTalk = [];
        let notTalk = [];
        for (var i = 0; i < inbounds_5995.length; i++) {
          if (inbounds_5995[i].user_talk_time != 0) {
            countTalk.push(inbounds_5995[i]);
          }else if (inbounds_5995[i].user_talk_time == 0) {
            notTalk.push(inbounds_5995[i]);
          }	
        }
        this.inTalk_5995 = countTalk;
        this.notTalk_5995 = notTalk;

        let sum = 0;
        for (var k = 0; k < countTalk.length; k++) {
          sum += countTalk[k].user_talk_time;
        }
        this.inSumTalk_5995 = sum

        let inGetProg = ((this.inTalk_5995.length / this.inbounds_5995.length) * 100);
        this.inGetProg_5995 = inGetProg;

        // -------------------------------- outbounds_5995 -----------------------------------------
        
        let outbounds_5995 = [];
        let outreports_5995 = [];
        for (var j = 0; j < calls.length; j++) {
          if (calls[j].gateway == '712075995' && calls[j].accountcode == 'outbound') {
            outbounds_5995.push(calls[j]);
            let infos = { 
              num: calls[j].caller_id_number,
              isxod_time: calls[j].user_talk_time
            }
            outreports_5995.push(infos);
          }
        }
        this.outbounds_5995 = outbounds_5995

        // ===========================================================

        const resultArr1 = [];

        const groupByNum1 = outreports_5995.reduce((group, item) => {
          const { num } = item;
          group[num] = group[num] ?? [];
          group[num].push(item.isxod_time);
          return group;
        }, {});

        Object.keys(groupByNum1).forEach((num) => {
          let counter = groupByNum1[num].length;
          groupByNum1[num] = groupByNum1[num].reduce((a, b) => a + b);
          resultArr1.push({
            'num': num,
            'isxod_time': groupByNum1[num],
            'for_all_time': groupByNum1[num],
            'isxod_count': counter
          })
        })
        this.outreports_5995 = resultArr1;

        // ===========================================================

        let ocountTalk = [];
        let notAnswer = [];
        for (var i = 0; i < outbounds_5995.length; i++) {
          if (outbounds_5995[i].user_talk_time != 0) {
            ocountTalk.push(outbounds_5995[i]);
          }else if (outbounds_5995[i].user_talk_time == 0) {
            notAnswer.push(outbounds_5995[i])
          }
        }
        this.outTalk_5995 = ocountTalk;
        this.notAnswer_5995 = notAnswer;

        let osum = 0;
        for (var k = 0; k < ocountTalk.length; k++) {
          osum += ocountTalk[k].user_talk_time;
        }
        this.outSumTalk_5995 = osum

        let outGetProg = ((this.outTalk_5995.length / this.outbounds_5995.length) * 100);
        this.outGetProg_5995 = outGetProg;
      },
      getReport_5995: function(){
        let vxods1 = this.inreports_5995;
        let isxods1 = this.outreports_5995;

        //--------------- bir birida yo'q elementlarni 0 bilan to'ldirish num bo'yicha ---------------
        let isxods = this.getMerge(isxods1, vxods1);
        let vxods = this.getMerge2(vxods1, isxods1);
        //--------------------------------- end -------------------------------------------------------
        let users = this.users;
        let reports = [];
          
        for (var m = 0; m < isxods.length; m++) {
          let num = isxods[m].num;
          for (var n = 0; n < vxods.length; n++) {
            if (num == vxods[n].num) {
              let infoss = {
                  id: num,
                  vxod_count: vxods[n].vxod_count,
                  vxod_time: vxods[n].vxod_time,
                  isxod_count: isxods[m].isxod_count,
                  isxod_time: isxods[m].isxod_time,
                  all_time: isxods[m].for_all_time+vxods[n].for_all_time,
              all_time_s: isxods[m].for_all_time+vxods[n].for_all_time,
                }
                reports.push(infoss);
            }
          }
        }
        
        let reps = [];
        for (var i = 0; i < users.length; i++) {
          let infoss = {
            num: users[i].num,
              name: users[i].name,
              vxod_count: 0,
              vxod_time: 0,
              isxod_count: 0,
              isxod_time: 0,
              all_time: 0,
              all_time_s: 0
            };
          for (var j = 0; j < reports.length; j++) {
            if (users[i].num === reports[j].id) {
              infoss = {
                num: users[i].num,
                  name: users[i].name,
                  vxod_count: reports[j].vxod_count,
                  vxod_time: reports[j].vxod_time,
                  isxod_count: reports[j].isxod_count,
                  isxod_time: reports[j].isxod_time,
                  all_time: reports[j].all_time,
                  all_time_s: reports[j].all_time_s
                }	
            }
          }
          reps.push(infoss)
        }
        var byVxod_count = reps.slice(0);
        byVxod_count.sort(function(a,b) {
          return a.name.localeCompare(b.name)
        });
        this.real_reports_5995 = byVxod_count
      },
      calcHMS: function(d, format = '0'){
        if (d == 0) {
            return 0;
          }else {
            d = Number(d);
          var h = Math.floor(d / 3600);
          var m = Math.floor(d % 3600 / 60);
          var s = Math.floor(d % 3600 % 60);

          var hDisplay = h > 0 ? h + (h == 1 ? " час, " : " час, ") : "";
          var mDisplay = m > 0 ? m + (m == 1 ? " мин, " : " мин, ") : "";
          var sDisplay = s > 0 ? s + (s == 1 ? " с" : " с") : "";
        if (format == '1') {
          mDisplay = m > 0 ? m + (m == 1 ? " мин" : " мин") : "";
          sDisplay = "";
        }
          return hDisplay + mDisplay + sDisplay;
          }
      },
      calcHMSexcel: function(d){
        if (d == 0) {
            return "00:00:00";
          }else {
            d = Number(d);
          var h = Math.floor(d / 3600);
          var m = Math.floor(d % 3600 / 60);
          var s = Math.floor(d % 3600 % 60);

          var hDisplay = h == 0 ? "00" : (h > 0 && h < 10) ? "0" + h : h;
          var mDisplay = m == 0 ? "00" : (m > 0 && m < 10) ? "0" + m : m;
          var sDisplay = s == 0 ? "00" : (s > 0 && s < 10) ? "0" + s : s;
          return hDisplay + ":" + mDisplay + ":" + sDisplay;
          }
      },
      getMerge(arr1, arr2) {
        let ids = arr1.map((elem) => elem.num)
        Object.values(arr2).forEach((el, index) => {
          if (!ids.includes(el.num)) {
            arr1.push({
              num: el.num,
              isxod_count: 0,
              isxod_time: "0",
              for_all_time: 0
            })
          }
        });
        return arr1
      },
      getMerge2(arr1, arr2) {
        let ids = arr1.map((elem) => elem.num)
        Object.values(arr2).forEach((el, index) => {
          if (!ids.includes(el.num)) {
            arr1.push({
              num: el.num,
              vxod_count: 0,
              vxod_time: "0",
              for_all_time: 0
            })
          }
        });
        return arr1
      },
      async getFifo(){
        let response = await axios({
          method: 'post',
          url: "https://api2.onlinepbx.ru/pbx12127.onpbx.ru/fifo/get.json",
          data: {
            asd: 'asdad'
          },
          headers: {
              "x-pbx-authentication": "<?= $key_and_id ?>"
          }
        });
        this.fifos = response.data.data;		 		
      },
      async fifoToReport(){
        let user_5995;

        for (var i = 0; i < this.fifos.length; i++) {
          if (this.fifos[i].num == "5201") {
            user_5995 = this.fifos[i].users;
          }
        }
        
        var myArray_5995 = user_5995.split(";");	
        this.availableOperators = myArray_5995;

        await this.personalMissed();
        await this.getUnknownClients();
        await this.getExtra();
              
        let reports_support = this.real_reports_5995;
        let set_support = [];

        for (var a = 0; a < reports_support.length; a++) {
          if (reports_support[a].num == '120') {
            continue;
          }
          for (var b = 0; b < myArray_5995.length; b++) {
            if (reports_support[a].num == myArray_5995[b]) {
              set_support.push(reports_support[a])
            }
          }
        }
        this.users_5995 = set_support;
      },
      async get_date(){
        let startDate = $('#start_date').val();
        let endDate = $('#get_date').val();

        let fromDate = Math.floor(new Date(startDate).getTime() / 1000);
        let toDate = Math.floor((new Date(endDate).getTime() / 1000)+86400);

        this.loading = true;
        await axios.get('monitoring/data', {params: {from: fromDate, to: toDate}}).then(response => {
          if (response.status == 200) {
            this.calls = response.data
            this.today = new Date()
            this.loading = false
          }
        });		
      }
    }
	})
</script>	
</body>
</html>