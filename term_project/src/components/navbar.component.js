import React, { Component } from 'react';
import { Link } from 'react-router-dom';

export default class Navbar extends Component {

  render() {
    return (
      <nav className="navbar navbar-dark bg-dark navbar-expand-lg">
        <Link to="/" className="navbar-brand">top 50 songs</Link>
        <div className="collpase navbar-collapse">
        <ul className="navbar-nav mr-auto">
          <li className="navbar-item">
          <Link to="/" className="nav-link">Songs</Link>
          </li>
          <li className="navbar-item">
          <Link to="/ArtistSearch" className="nav-link">ArtistSearch</Link>
          </li>
          <li className="navbar-item">
          <Link to="/TitleSearch" className="nav-link">TitleSearch</Link>
          </li>
          <li className="navbar-item">
          <Link to="/RankSearch" className="nav-link">RankSearch</Link>
          </li>
        </ul>
        </div>
      </nav>
    );
  }
}