import React from 'react';
import { BrowserRouter, Route , Routes} from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import Navbar from "./components/navbar.component"
import SongList from "./components/song-list.component";
import ArtistSearch from "./components/search.component";
import Artist from "./components/artist.component";
import TitleSearch from "./components/titlesearch.component";
import Title from "./components/title.component";
import RankSearch from "./components/ranksearch.component";
import Rank from "./components/rank.component";

function App() {
 return (
   <BrowserRouter>
      <Navbar/>
      <Routes>
        <Route path="/" element={<SongList/>} />
        <Route path="/ArtistSearch" element={<ArtistSearch/>}/>
        <Route path="/Artist" element={<Artist/>}/>
        <Route path="/TitleSearch" element={<TitleSearch/>}/>
        <Route path="/Title" element={<Title/>}/>
        <Route path="/RankSearch" element={<RankSearch/>}/>
        <Route path="/Rank" element={<Rank/>}/>
      </Routes>
   </BrowserRouter>
 );
}
 
export default App;
