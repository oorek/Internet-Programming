
const express = require('express');
const cors = require('cors');
const mongoose = require('mongoose');

require('dotenv').config();

const app = express();
const port = process.env.PORT || 5000;

app.use(cors());
app.use(express.json());

const uri = process.env.ATLAS_URI;
mongoose.connect(uri, 
);
const connection = mongoose.connection;
connection.once('open', () => {
  console.log("MongoDB database connection established successfully");
})

const countryRouter = require('./routes/song');
const crawlingRouter = require('./routes/crawling');
const ArtistsearchRouter = require('./routes/ArtistSearch');
const TitlesearchRouter = require('./routes/TitleSearch');
const RanksearchRouter = require('./routes/RankSearch');

app.use('/song', countryRouter);
app.use('/crawling', crawlingRouter);
app.use('/ArtistSearch', ArtistsearchRouter);
app.use('/TitleSearch', TitlesearchRouter);
app.use('/RankSearch', RanksearchRouter);

app.listen(port, () => {
    console.log(`Server is running on port: ${port}`);
});