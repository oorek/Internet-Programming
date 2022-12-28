const axios = require("axios");
const cheerio = require("cheerio");
const iconv = require("iconv-lite");

const router = require('express').Router();
let Song = require('../models/songs.models');

router.route('/').get(async(req, res) => {
  try{
    const html = await axios.get("https://www.genie.co.kr/chart/top200");
    let ulList = [];

    //const content = iconv.decode(html.data, "EUC-KR").toString();
    const $ = cheerio.load(html.data);
    const bodyList = $("tr.list");
    var length = bodyList.length;
    console.log(length);
    bodyList.map((i, element) => {
      ulList[i] = {
        thumbnailUrl : $(element).find("td a img").attr("src").replace(/\/\//g, "http://"),
        rank: i+1,
        title : $(element).find("td.info a.title").text().replace(/\s/g, ""),
        artist : $(element).find("td.info a.artist").text().replace(/\s/g, ""),
      };
      const thumbnailUrl = ulList[i].thumbnailUrl;
      const rank = ulList[i].rank;
      const title = ulList[i].title;
      const artist = ulList[i].artist;
      const newSong = new Song({
        rank,
        thumbnailUrl,
        title,
        artist,
      });
      newSong.save()
        //.then(() => res.json('User added!'))
        //.catch(err => res.status(400).json('Error: ' + err));
    });
    console.log("bodyList : ", ulList);
    

  }catch(error){
    console.log(error)
    res.send({result: "fail", message: "크롤링에 문제가 발생했습니다.", error:error});
  }
});


module.exports = router;


/*
const log = console.log;
const getHtml = async () => {
  try {
    return await axios.get("https://product.kyobobook.co.kr/bestseller/online?period=001#?page=1&per=20&ymw=&period=001&saleCmdtClstCode=&dsplDvsnCode=000&dsplTrgtDvsnCode=001&saleCmdtDsplDvsnCode=");
  } catch (error) {
    console.error(error);
  }
};

getHtml()
  .then(html => {
    let ulList = [];
    const $ = cheerio.load(html.data);
    //const $bodyList = $("div.headline-list ul").children("li.section02");
    const $bodyList = $("ol li");
    console.log($bodyList);
    var length = $bodyList.length;
    console.log(length);
    $bodyList.each(function(i, elem) {
      ulList[i] = {
          title: $(this).find('strong.news-tl a').text(),
          url: $(this).find('strong.news-tl a').attr('href'),
          image_url: $(this).find('p.poto a img').attr('src'),
          image_alt: $(this).find('p.poto a img').attr('alt'),
          summary: $(this).find('p.lead').text().slice(0, -11),
          date: $(this).find('span.p-time').text()
      };
    });

    const data = ulList.filter(n => n.title);
    return data;
  })
  .then(res => log(res));

  module.exports = router;
  */