// Import request and cheerio libraries
const request = require("request");
const cheerio = require("cheerio");

// Set an example youtube url
//let videoUrl = 'https://www.youtube.com/watch?v=7fYKMCCPh28';
let videoUrl1 = "https://www.youtube.com/watch?v=lncNcNtGkJY";

// HTTP GET of the youtube website using request
request.get(videoUrl1, function(error, response, html) {
    // Use cheerio to parse and create the jQuery-like DOM based on the retrieved html string
    let $page = cheerio.load(html);

    // Find the element node which contains the title and retrieve it's text
    let title = $page("span#eow-title").text();
    //let views = $page('.view-count).text();
    // Output the result
    console.log("The title of the video %s is %s", videoUrl1, title);
    // Output: The title of the video https://www.youtube.com/watch?v=7fYKMCCPh28 is The Earth: 4K Extended Edition
});
