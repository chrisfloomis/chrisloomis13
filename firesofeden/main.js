var express = require('express');

var app = express();
var handlebars = require('express-handlebars').create({defaultLayout:'main'});
var bodyParser = require('body-parser');
//var owm = require('./owm.js');
var request = require('request');

app.engine('handlebars', handlebars.engine);
app.set('view engine', 'handlebars');
app.set('port', 3000);
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(express.static('public'));

app.get('/',function(req,res){
	var context = {};
	request('http://api.openweathermap.org/data/2.5/forecast/daily?q=oakland&units=imperial&cnt=7&APPID=ac8c02ef8cf7667fb84c8c8dc20ec383', get7Day);

	function get7Day(err, response, body){
		if(!err && response.statusCode < 400){
			var foo = JSON.parse(body);
			//var bar = JSON.parse(JSON.stringify(foo.list));
			//var baz = JSON.parse(JSON.stringify(bar.temp));
			var params = [];
			
			//params.push({'daynum':day,'temp':parsed});
			var day = new Date();//1;
			
			for(q in foo.list){
				params.push(
					{'daynum': day.getMonth()+1+"-"+day.getDate(),
					 'temp':JSON.stringify(foo.list[q].temp.day),
					 'hum':JSON.stringify(foo.list[q].humidity),
					 'des':foo.list[q].weather[0].description,
					 'icon':foo.list[q].weather[0].icon});
				day.setDate(day.getDate()+1);
			}
			
			context.city = (JSON.stringify(foo.city.name)+", "+JSON.stringify(foo.city.country)).replace(/\"/g, "");
			context.forecast = params;
			//context.test = JSON.stringify(foo.list[0].temp.day);
			res.render('7Day',context);
		}
		else{
			console.log(err);
			console.log(response.statusCode);
		}
	}
});

app.use(function(req,res){
  res.status(404);
  res.render('404');
});

app.use(function(err, req, res, next){
  console.error(err.stack);
  res.type('plain/text');
  res.status(500);
  res.render('500');
});

app.listen(app.get('port'), function(){
  console.log('Express started on http://localhost:' + app.get('port') + '; press Ctrl-C to terminate.');
});