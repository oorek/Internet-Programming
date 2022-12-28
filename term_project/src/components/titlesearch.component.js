import React, { Component } from 'react';

export default class SearchSong extends Component {
  constructor(props) {
    super(props);

    this.onSearchTitle = this.onSearchTitle.bind(this);
    this.onSubmit = this.onSubmit.bind(this);

    this.state = {
      title: ''
    }
  }

  onSearchTitle(e) {
    this.setState({
      title: e.target.value
    });
  }

  onSubmit(e) {
    e.preventDefault();
    const title = {
        title : this.state.title
    };

   /* axios.get('http://localhost:5000/ArtistSearch',{
        params: {
            title: this.state.title
        }
    })
      .then(res => console.log(res.data));
*/
    window.location = '/Title?title:' + this.state.title;
   // window.location = '/ArtistSearch'
  }


  render() {
    return (
      <div>
        <h3>Search Title</h3>
        <form onSubmit={this.onSubmit}>
          <div className="form-group"> 
            <label>Title: </label>
            <input  type="text"
                required
                className="form-control"
                value={this.state.title}
                onChange={this.onSearchTitle}
                />
          </div>
          <div className="form-group">
            <input type="submit" value="Search Song" className="btn btn-primary" />
          </div>
        </form>
      </div>
    )
  }
}