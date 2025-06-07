<footer class="app-footer">
    <div class="container container--footer">
        <div class="footer-nav-container">
            <div class="footer-nav-item">
                <a href="{{ route('home') }}" class="app-logo"><img src="{{secure_asset('icons/logo_w.svg')}}" alt="SkyJett — логотип"></a>
                <p>Ваш надежный партнер для комфортных и безопасных путешествий по всему миру.</p>
                <div class="footer-nav-social">
                    <a href="#facebook"><img src="{{secure_asset('icons/fb.svg')}}" alt="Facebook"></a>
                    <a href="#X"><img src="{{secure_asset('icons/x.svg')}}" alt="X"></a>
                    <a href="#vk"><img src="{{secure_asset('icons/vk.svg')}}" alt="VK"></a>
                    <a href="#tg"><img src="{{secure_asset('icons/tg.svg')}}" alt="Telegram"></a>
                </div>
            </div>
            <div class="footer-nav-item">
                <h3 class="footer-nav-title">Информация</h3>
                <ul>
                    <li><a href="#about">О компании</a></li>
                    <li><a href="{{ route('flights.index') }}">Рейсы</a></li>
                    <li><a href="#services">Услуги</a></li>
                    <li><a href="#reviews">Отзывы</a></li>
                </ul>
            </div>
            <div class="footer-nav-item">
                <h3 class="footer-nav-title">Контакты</h3>
                <ul>
                    <li><span class="footer-nav-icon"><img src="{{secure_asset('icons/phone_sm_gr.svg')}}" alt="Телефон"></span><a href="tel:+7 (800) 123-45-67">+7 (800) 123-45-67</a></li>
                    <li><span class="footer-nav-icon"><img src="{{secure_asset('icons/email_sm_gr.svg')}}" alt="Почта"></span><a href="mailto:info@skyjett.ru">info@skyjett.ru</a></li>
                    <li><span class="footer-nav-icon"><img src="{{secure_asset('icons/office_sm_gr.svg')}}" alt="Офис"></span>г. Москва, ул. Авиационная, 15</li>
                    <li><span class="footer-nav-icon"><img src="{{secure_asset('icons/clocks_sm_gr.svg')}}" alt="Часы"></span>Пн-Пт: 9:00 - 18:00</li>
                </ul>
            </div>
            <div class="footer-nav-item">
                <h3 class="footer-nav-title">Подписка</h3>
                <p>Подпишитесь на нашу рассылку, чтобы получать информацию о специальных предложениях и акциях.</p>
                <form class="footer-nav-subcription" onsubmit="event.preventDefault()">
                    <input type="email" id="subscription-email" placeholder="Ваш email" autocomplete="email">
                    <button aria-label="Подписаться на рассылку">→</button>
                </form>
            </div>
        </div>
        <p class="footer-sign">© 2025 SkyJett. Все права защищены.</p>
    </div>
</footer>