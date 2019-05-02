<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Album\AlbumEloquentRepository;
use App\Repositories\Artist\ArtistEloquentRepository;
use App\Repositories\Genre\GenreEloquentRepository;
use App\Repositories\Track\TrackEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $_trackRepository, $_genreRepository, $_albumRepository, $_artistRepository;

    public function __construct()
    {
        $this->setTrackRepositoty();
        $this->setGenreRepository();
        $this->setAlbumRepository();
        $this->setArtistRepository();
    }

    public function setTrackRepositoty()
    {
        $this->_trackRepository = new TrackEloquentRepository();
    }

    public function setGenreRepository()
    {
        $this->_genreRepository = new GenreEloquentRepository();
    }

    public function setAlbumRepository()
    {
        $this->_albumRepository = new AlbumEloquentRepository();
    }

    public function setArtistRepository()
    {
        $this->_artistRepository = new ArtistEloquentRepository();
    }

    public function index()
    {
        $data['title_page'] = trans('home_index.title');
        $data['weekly_top_15'] = $this->_trackRepository->getTracksWeekly();
        $data['top_genres'] = $this->_genreRepository->getTopGenres();
        $data['featured_albums'] = $this->_albumRepository->getFeaturedAlbums();
        $data['featured_artists'] = $this->_artistRepository->getFeaturedArtists();
        $data['release_tracks'] = $this->_trackRepository->getReleaseTracks();

        return view('home.index', $data);
    }
}