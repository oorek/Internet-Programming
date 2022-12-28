import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import {useState} from 'react';

const Song = props => (
  <tr>
    <td><img src = {props.song.thumbnailUrl}/></td>
    <td>{props.song.rank}</td>
    <td>{props.song.title}</td>
    <td>{props.song.artist}</td>
  </tr>
)


export default class SongsList extends Component {
  constructor(props) {
    super(props);

    this.state = {songs: []};
  }

  componentDidMount() {
    axios.get('http://localhost:5000/song')
      .then(response => {

        this.setState({ songs: response.data })
      })
      .catch((error) => {
        console.log(error);
      })
  }

  songList() {
    return this.state.songs.map(currentsong => {
      //return <img src={currentsong.thumbnailUrl} /> ;
      return <Song song={currentsong}/>;
    })
  }

  render() {
    return (
      <div>
        <h3>Logged Songs</h3>
        <table className="table">
          <thead className="thead-light">
            <tr>
              <th>thumbnailUrl</th>  
              <th>rank</th>
              <th>title</th>
              <th>Artist</th>
            </tr>
          </thead>
          <tbody>
            { this.songList() }
          </tbody>
        </table>
      </div>
    )
  }
}