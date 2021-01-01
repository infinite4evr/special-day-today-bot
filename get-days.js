const axios = require("axios");
var fs = require("fs");
const _ = require("lodash");
var jsdom = require("jsdom");
const $ = require("jquery")(new jsdom.JSDOM().window);

var now = new Date();
var days = [];
for (var d = new Date(2020, 0, 1); d <= now; d.setDate(d.getDate() + 1)) {
	let day = _.toLower(
		_.trim(
			d.toLocaleString("default", { month: "long" }) +
				"_" +
				String(d.getDate()).padStart(2, "0")
		)
	);
	days.push(day);

	console.log(day);
}

console.log(days);

function sleep(ms) {
	return new Promise((resolve) => setTimeout(resolve, ms));
}

async function getDays() {
	days.forEach(async (day) => {
		try {
			const result = await axios.get(`http://en.wikipedia.org/wiki/` + day);

			const wiki = $(result.data);

			let writeStream = fs.createWriteStream("data/" + day + ".txt");

			console.log(day + " ");

			_.forEach($(wiki.find('span[id="Holidays_and_observances"]')), (span) => {
				let text = "";
				_.forEach($(span).parent().next().children(), (li) => {
					if (!$(li).text().match("Christian feast day:")) {
						text = text + $(li).text() + "\n";
					}
				});

				if (text.length === 0) {
					console.log("date empty for " + day);
				}

				console.log("Writing dates for " + day + "\n");

				writeStream.on("open", function (fd) {
					writeStream.write(text, (error) => console.log(error, day));
				});

				// This is here incase any errors occur
				writeStream.on("error", function (err) {
					console.log(err);
				});
			});
		} catch (err) {
			console.log("Error occoured for date : " + day + "\n" + err);
		}
		sleep(1000);
	});
}

getDays();
